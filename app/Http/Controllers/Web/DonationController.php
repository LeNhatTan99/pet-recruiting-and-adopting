<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{

        /**
     * Redirect to route payment momo
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function donate(Request $request) {
        try {
            $userId = Auth::guard('web')->user()->id;
            DB::beginTransaction();
            $payUrl = $this->createPayment($userId, $request->amount);
            return redirect()->to($payUrl);
        } catch (\Exception $e) {
            Log::error('[DonationController][donate] error ' . $e->getMessage());
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to redirect payment']);
        }
    }

         /**
     * Save data donate and redirect 
     * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Contracts\View\View|View
     */
    public function createDonate(Request $request) {
        try {
            DB::beginTransaction();

            // Get the transaction id when creating a signature and decrypt it to get back the user id
            $parts = explode(':', $request->orderId);
            if (count($parts) > 1) {
                $userId = $parts[1];
            } else {
                $userId = Auth::guard('web')->user()->id;
            }
            $params = [
                'user_id' => $userId,
                'amount' =>$request->amount,
                'donation_date' => Carbon::now(),
            ];
            Donation::create($params);
            DB::commit();
            return redirect()->route('donationCases')->with(['success' => 'Donate successfully']);
        } catch (\Exception $e) {
            Log::error('[DonationController][createDonate] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->route('donationCases')->with(['error' => 'Failed to donate']);
        }
    }

        /**
     * Creates a payment request for MoMo payment gateway.
     *
     * @param int $userId The user ID initiating the payment.
     * @param float $totalPayment The total payment amount.
     * @return string|null The payment URL if successful, or null if an error occurs.
     */
    function createPayment($userId, $totalPayment) {
        try {
            //Url Initialize create payment of Momo
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

            // Your account information when registering with Momo
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $redirectUrl = route('user.create.donate'); //route navigation when payment is complete
            $ipnUrl = route('donationCases'); //route Momo returns transaction results

            // Initialize data for Momo needed to create a signature to authenticate the transaction
            $orderId = time().":".$userId;
            $amount = $totalPayment;
            $extraData = base64_encode(json_encode(['donate' => $orderId]));
            $requestId = time() ."id";
            $requestType = "captureWallet"; 
            $orderInfo = "Donate for animal cases with Momo";

            // Signature to confirm the transaction in the format of Momo
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array(
                        'partnerCode' => $partnerCode,
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderId,
                        'orderInfo' => $orderInfo,
                        'redirectUrl' => $redirectUrl,
                        'ipnUrl' => $ipnUrl,
                        'lang' => 'vi',
                        'extraData' => $extraData,
                        'requestType' => $requestType,
                        'signature' => $signature,
                    );

            // Send payment request to Momo
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true); 
            if (!empty($jsonResult)) {
                return $jsonResult['payUrl'];
            } 
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Payment failed');
        }
    }

        /**
     * Executes a POST request using cURL to a specified URL with the provided data.
     *
     * @param string $url The URL to send the POST request to.
     * @param string $data The data to be included in the POST request.
     * @return string|false The response from the POST request or false on failure.
     */
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }


}
