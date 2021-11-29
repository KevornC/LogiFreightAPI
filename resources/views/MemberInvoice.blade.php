
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LogiFreight Invoice </title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    </head>

    <body>
        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="w-3/5 bg-white shadow-lg">
                <div class="flex justify-between p-4">
                    <div>
                        <h1 class="text-3xl italic font-extrabold tracking-widest text-indigo-500">LogiFreight Limited</h1>
                        <p class="text-base">If account is not paid within 7 days the credits details supplied as
                            confirmation.</p>
                    </div>
                    <div class="p-2">
                        <ul class="flex">
                            <li class="flex flex-col items-center p-2 border-l-2 border-indigo-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                                <span class="text-sm">
                                    www.LogiFreight.com
                                </span>
                                <span class="text-sm">
                                    www.LogiFreightLimited.com
                                </span>
                            </li>
                            <li class="flex flex-col p-2 border-l-2 border-indigo-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm">
                                    Fort Laverdale, Florida, USA
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full h-0.5 bg-indigo-500"></div>
                <div class="flex justify-between p-4">
                    <div>
                        <h6 class="font-bold">Order Date : <span class="text-sm font-medium"> 12/12/2022</span></h6>
                        <h6 class="font-bold">Order ID : <span class="text-sm font-medium"> 12/12/2022</span></h6>
                    </div>
                    <div class="w-40">
                        <address class="text-sm">
                            <span class="font-bold"> Billed To : </span>
                            Joe Smith
                            795 Folsom Ave
                            San Francisco, CA 94107
                            P: (123) 456-7890
                        </address>
                    </div>
                    <div class="w-40">
                        <address class="text-sm">
                            <span class="font-bold">Ship To :</span>
                            Joe doe
                            800 Folsom Ave
                            San Francisco, CA 94107
                            P: + 111-456-7890
                        </address>
                    </div>
                    <div></div>
                </div>
                <div class="flex justify-center p-4">
                    <div class="border-b border-gray-200 shadow">
                        <table class="">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Package Tracking#
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Package Name
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Package Description
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Package Quanity
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Package Cost
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Rate
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Handling Fee
                                    </th>
                                    <th class="px-4 py-2 text-xs text-gray-500 ">
                                        Custom Fee
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
								@foreach($data as $info)
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{$info->packagedetail->Package_TN}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{$info->packagedetail->package->package_name}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{$info->packagedetail->package->package_desc}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">
                                            {{$info->packagedetail->quantity}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            ${{number_format($info->packagedetail->est_cost,2)}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{$info->rate->rate_per_pound}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            ${{number_format($info->handling_fee,2)}}
                                        </div>
                                    </td>
                                    @if($info->custom_fee==50)
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            $0.00
                                        </div>
                                    </td>
                                    @else
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            ${{number_format($info->custom_fee,2)}}
                                        </div>
                                    </td>
                                    @endif
                            
                                </tr>
								@endforeach
                                {{-- <tr class="">
                                    <td colspan="3"></td>
                                    <td class="text-sm font-bold">Sub Total</td>
                                    <td class="text-sm font-bold tracking-wider"><b>$950</b></td>
                                </tr> --}}
                                <!--end tr-->
                                {{-- <tr>
                                    <th colspan="3"></th>
                                    <td class="text-sm font-bold"><b>Tax Rate</b></td>
                                    <td class="text-sm font-bold"><b>$1.50%</b></td>
                                </tr> --}}
                                <!--end tr-->
                                <?php
                                $total=0;
                                foreach ($data as $key) {
                                    # code...
                                    $total+=$key->Total_price;
                                }
                                ?>
                                <tr class="text-white bg-gray-800">
                                    <th colspan="3"></th>
                                    <td class="text-sm font-bold"><b>Total</b></td>
                                    <td class="text-sm font-bold"><b>${{number_format($total,2)}}</b></td>
                                </tr>
                                <!--end tr-->

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-between p-4">
                    <div>
                        <h3 class="text-xl">Terms And Condition :</h3>
                        <ul class="text-xs list-disc list-inside">
                            <li>All accounts are to be paid within 7 days from receipt of invoice.</li>
                            <li>To be paid by cheque or credit card or direct payment online.</li>
                            <li>If account is not paid within 7 days the credits details supplied.</li>
                        </ul>
                    </div>
                    <div class="p-4">
                        <h3>Signature</h3>
                        <div class="text-4xl italic text-indigo-500">K.Callum</div>
                    </div>
                </div>
                <div class="w-full h-0.5 bg-indigo-500"></div>

                <div class="p-4">
                    <div class="flex items-center justify-center">
                        Thank you very much for doing business with us.
                    </div>
                    {{-- <div class="flex items-end justify-end space-x-3">
                        <button class="px-4 py-2 text-sm text-green-600 bg-green-100">Print</button>
                        <button class="px-4 py-2 text-sm text-blue-600 bg-blue-100">Save</button>
                        <button class="px-4 py-2 text-sm text-red-600 bg-red-100">Cancel</button>
                    </div> --}}
                </div>

            </div>
        </div>
        {{-- <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="w-6/12 mt-4 text-left bg-white shadow-lg">
                <div class="flex justify-between px-8 py-6">
                    <div class="flex items-center">
                        sale invoice
                    </div>
                    <div class="flex items-center gap-4">
                        <button class="px-2 py-1 bg-gray-200 hover:bg-gray-400">Save</button>
                        <button class="px-2 py-1 bg-gray-200 hover:bg-gray-400">Print</button>
                    </div>
                </div>
                <div class="w-full h-0.5 bg-gray-800"></div>

            </div>
        </div> --}}
    </body>

</html>