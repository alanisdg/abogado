<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ptondereau\LaravelUpsApi\Facades\UpsTracking as FacadesUpsTracking;
//use Ptondereau\LaravelUpsApi\Facades\UpsShipping;
//use Ptondereau\LaravelUpsApi\Facades\UpsTracking;
use Ups;

// Models
use App\Models\Percentage;
use App\Models\Country;

class UpsController extends Controller
{
    protected $config = [
        "moduleName" => "UPS Services",
        "routeView" => "backend.modules.ups.",
        "routeLink" => "ups"
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Tracking
     */
    public function tracking()
    {
        return view($this->config["routeView"] . "tracking")
                ->with("config", $this->config);
    }
    /**
     * Tracking search
     */
    public function trackingSearch(Request $request)
    {
        $accessKey = "4D9A7C0B43E654F5";
        $userId = "PRAIATURISMO";
        $password = "3627078Erick12.*";

        $tracking = new Ups\Tracking($accessKey, $userId, $password);

        try {
            $shipment = $tracking->track($request->input("code"));

            $destination = $shipment->ShipTo;

            foreach($shipment->Package->Activity as $activity) {
                return response()->json([$activity, $destination]);
            }

        } catch (Exception $e) {
            var_dump($e);
        }

    }
    /**
     * Shipment
     */
    public function shipment()
    {
        return view($this->config["routeView"] . "shipment")
                ->with("config", $this->config);
    }
    /**
     * Shipment search
     */
    public function shipmentSearch(Request $request)
    {
        // Percentage
            $percentage = Percentage::first(['value']);

        //dd($request->all());
        $accessKey = "4D9A7C0B43E654F5";
        $userId = "PRAIATURISMO";
        $password = "3627078Erick12.*";

        $rate = new Ups\Rate(
            $accessKey,
            $userId,
            $password
        );

        try {
            $shipment = new \Ups\Entity\Shipment();

            $shipperAddress = $shipment->getShipper()->getAddress();
            $shipperAddress->setPostalCode('99205');

            $address = new \Ups\Entity\Address();
            $address->setPostalCode($request->input('code_origin'));
            $shipFrom = new \Ups\Entity\ShipFrom();
            $shipFrom->setAddress($address);

            $shipment->setShipFrom($shipFrom);

            $shipTo = $shipment->getShipTo();
            $shipTo->setCompanyName('Praiaenvios');
            $shipToAddress = $shipTo->getAddress();
            $shipToAddress->setPostalCode($request->input('code_destination'));

            $package = new \Ups\Entity\Package();
            $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
            $package->getPackageWeight()->setWeight($request->input('weight'));

            $dimensions = new \Ups\Entity\Dimensions();
            $dimensions->setHeight($request->input('height'));
            $dimensions->setWidth($request->input('width'));
            $dimensions->setLength($request->input('length'));

            $unit = new \Ups\Entity\UnitOfMeasurement;
            $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);

            $dimensions->setUnitOfMeasurement($unit);
            $package->setDimensions($dimensions);

            $shipment->addPackage($package);

            foreach($rate->getRate($shipment) as $data) {
                foreach ($data as $value) {
                    return response()->json([$value->TransportationCharges, $value->ServiceOptionsCharges, $value->TotalCharges, (int)$percentage->value]);
                }
            }

        } catch (Exception $e) {
            var_dump($e);
        }
    }
    /**
     * Time transit
     */
    public function timeTransit()
    {
        return view($this->config["routeView"] . "time-transit")
                ->with("countries", Country::get(["id", "iso", "name"]))
                ->with("config", $this->config);
    }
    /**
     * Time transit search
     */
    public function timeTransitSearch(Request $request)
    {
        //dd($request->all());
        $accessKey = "4D9A7C0B43E654F5";
        $userId = "PRAIATURISMO";
        $password = "3627078Erick12.*";

        $postal_code_origin = $request->input("postal_code_origin");
        $country_origin_code = $request->input("country_origin_code");
        $destination_zip_code = $request->input("destination_zip_code");
        $destination_country_code = $request->input("destination_country_code");

        $timeInTransit = new Ups\TimeInTransit($accessKey, $userId, $password);

        try {
            $request = new \Ups\Entity\TimeInTransitRequest;

            // Addresses
            $from = new \Ups\Entity\AddressArtifactFormat;
            //$from->setPoliticalDivision3('Amsterdam');
            $from->setPostcodePrimaryLow($postal_code_origin);
            $from->setCountryCode($country_origin_code);
            $request->setTransitFrom($from);

            $to = new \Ups\Entity\AddressArtifactFormat;
            //$to->setPoliticalDivision3('Amsterdam');
            $to->setPostcodePrimaryLow($destination_zip_code);
            $to->setCountryCode($destination_country_code);
            $request->setTransitTo($to);

            // Weight
            $shipmentWeight = new \Ups\Entity\ShipmentWeight;
            $shipmentWeight->setWeight('10');
            $unit = new \Ups\Entity\UnitOfMeasurement;
            $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
            $shipmentWeight->setUnitOfMeasurement($unit);
            $request->setShipmentWeight($shipmentWeight);

            // Packages
            $request->setTotalPackagesInShipment(2);

            // InvoiceLines
            $invoiceLineTotal = new \Ups\Entity\InvoiceLineTotal;
            $invoiceLineTotal->setMonetaryValue(100.00);
            $invoiceLineTotal->setCurrencyCode('USD');
            $request->setInvoiceLineTotal($invoiceLineTotal);

            // Pickup date
            //$request->setPickupDate(new DateTime);

            // Get data
            $times = $timeInTransit->getTimeInTransit($request);

            foreach($times->ServiceSummary as $serviceSummary) {
                dd($serviceSummary->EstimatedArrival);
            }
            //return response()->json($value);

        } catch (Exception $e) {
            dd($e);
        }
    }
}
