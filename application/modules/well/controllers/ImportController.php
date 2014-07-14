<?php

class Well_ImportController extends Well_Model_Controller_Well
{

    public function init ()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        parent::init();
        
        if (PHP_SAPI != 'cli') {
            throw new Zend_Exception("Cannot access this resource.");    
        }
        
    }

    
    public function drillerAction()
    {
        $out = new Application_Model_Colors();
        
        $file = APPLICATION_PATH."/data/driller.txt";
        
        $lines = $this->csv_to_array($dataPath. $file, "\t");
        
        foreach($lines as $line){
            $data = array(
            	    'license_nbr' => $line['license_nbr'],
                    'license_type' => $line['license_type'],
                    'name_last' => $line['name_last'],
                    'name_first' => $line['name_first'],
                    'street' => $line['street'],
                    'city' => $line['city'],
                    'state' => $line['state'],
                    'zip' => $line['zip'],
                    'phone' => $line['phone'],
                    'name_company' => $line['name_company'],
                    'business_street' => $line['business_street	'],
                    'business_city' => $line['business_city'],
                    'business_state' => $line['business_state'],
                    'business_zip' => $line['business_zip'],
                    'business_phone' => $line['business_phone'],
                    'bonded' => $line['bonded']
            );
            
            
        }
    }
    
    public function indexAction ()
    {
        $form = $this->getCreateForm()->import();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid(
                    $this->getRequest()
                        ->getPost())) {
                
                $this->_helper->layout()->disableLayout();
                $this->_helper->viewRenderer->setNoRender(true);
                echo '<html><head><style type="text/css">body {font-family:Courier;color: #CCCCCC;background: #000000;border: 3px double #CCCCCC;padding: 10px;}</style> </head><body>';
                
                // success - do something with the uploaded file
                $uploadedData = $form->getValues();
                $fullFilePath = $form->file->getFileName();
                
                $lines = $this->csv_to_array($fullFilePath, "\t");
                
                $count = 0;
                foreach ($lines as $line) {
                    @ob_end_clean();
                    ob_start();
                    $data = array();
                    
                    $data = array(
                            'wl_county_code' => strtolower(
                                    $line['wl_county_code']),
                            'wl_nbr' => $line['wl_nbr'],
                            'wl_version' => $line['wl_version'],
                            'well_tag_nbr' => $line['well_tag_nbr'],
                            'name_last' => ucwords(
                                    strtolower($line['name_last'])),
                            'name_first' => ucwords(
                                    strtolower($line['name_first'])),
                            'name_first' => ucwords(
                                    strtolower($line['name_first'])),
                            'name_company' => ucwords(
                                    strtolower($line['name_company'])),
                            'street' => ucwords(strtolower($line['street'])),
                            'city' => ucwords(strtolower($line['city'])),
                            'state' => ucwords(strtolower($line['state'])),
                            'zip' => $line['zip'],
                            'type_of_log' => $line['type_of_log'],
                            'depth_first_water' => $line['depth_first_water'],
                            'depth_drilled' => $line['depth_drilled'],
                            'completed_depth' => $line['completed_depth'],
                            'post_static_water_level' => $line['post_static_water_level'],
                            'start_date' => date("Y-m-d", 
                                    strtotime(
                                            str_replace('-', '/', 
                                                    $line['start_date']))),
                            'complete_date' => date("Y-m-d", 
                                    strtotime(
                                            str_replace('-', '/', 
                                                    $line['complete_date']))),
                            'received_date' => date("Y-m-d", 
                                    strtotime(
                                            str_replace('-', '/', 
                                                    $line['received_date']))),
                            'startcard_nbr' => $line['startcard_nbr'],
                            'bonded_license_nbr' => $line['bonded_license_nbr'],
                            'work_new' => ($line['work_new'] == 'X' ? 1 : 0),
                            'work_abandonment' => ($line['work_abandonment'] ==
                                     'X' ? 1 : 0),
                                    'work_deepening' => ($line['work_deepening'] ==
                                     'X' ? 1 : 0),
                                    'work_alteration' => ($line['work_alteration'] ==
                                     'X' ? 1 : 0),
                                    'work_conversion' => ($line['work_conversion'] ==
                                     'X' ? 1 : 0),
                                    'work_other' => ($line['work_other'] == 'X' ? 1 : 0),
                                    'use_domestic' => ($line['use_domestic'] ==
                                     'X' ? 1 : 0),
                                    'use_irrigation' => ($line['use_irrigation'] ==
                                     'X' ? 1 : 0),
                                    'use_community' => ($line['use_community'] ==
                                     'X' ? 1 : 0),
                                    'use_livestock' => ($line['use_livestock'] ==
                                     'X' ? 1 : 0),
                                    'use_industrial' => ($line['use_industrial'] ==
                                     'X' ? 1 : 0),
                                    'use_injection' => ($line['use_injection'] ==
                                     'X' ? 1 : 0),
                                    'use_thermal' => ($line['use_thermal'] == 'X' ? 1 : 0),
                                    'use_dewatering' => ($line['use_dewatering'] ==
                                     'X' ? 1 : 0),
                                    'use_piezometer' => ($line['use_piezometer'] ==
                                     'X' ? 1 : 0),
                                    'use_other' => ($line['use_other'] == 'X' ? 1 : 0),
                                    'township' => $line['township'],
                                    'township_char' => $line['township_char'],
                                    'range' => $line['range'],
                                    'range_char' => $line['range_char'],
                                    'sctn' => $line['sctn'],
                                    'qtr160' => $line['qtr160'],
                                    'qtr40' => $line['qtr40'],
                                    'tax_lot' => $line['tax_lot'],
                                    'street_of_well' => ucwords(
                                            strtolower($line['street_of_well'])),
                                    'location_county' => ucwords(
                                            strtolower($line['location_county'])),
                                    'longitude' => $line['longitude'],
                                    'latitude' => $line['latitude'],
                                    'bonded_name_last' => ucwords(
                                            strtolower(
                                                    $line['bonded_name_last'])),
                                    'bonded_name_first' => ucwords(
                                            strtolower(
                                                    $line['bonded_name_first'])),
                                    'max_yield' => $line['max_yield'],
                                    'created' => time()
                    );
                    
                    $wellId = $this->getWellModel()->create($data);
                    
                    echo 'Created well #' . $wellId . '<br />';
                    $count ++;
                    ob_end_flush();
                    flush();
                }
                
                // $this->setFlashSuccess('Created ' . $count .' wells');
                $this->redirect('/well/import');
            }
        }
        $this->view->form = $form;
    }

    public function fixAction()
    {
        $out = new Application_Model_Colors();
        
        $dataPath = APPLICATION_PATH."/data/";

        $files = scandir($dataPath);
        
        $wellModel = new Well_Model_Well();
        
        foreach ($files as $file) {
            if($file != "." || $file != "..") {
                // open file and parse
                $lines = $this->csv_to_array($dataPath. $file, "\t");
                
                foreach ($lines as $line) {
                    @ob_end_clean();
                    ob_start();
                    
                   $wellNbr = $line['wl_nbr'];
                    
                   $well = $wellModel->findByWellNbr($wellNbr);
                   if($well->id < 1) {
                       echo $out->getColoredString("Error no well for {$wellNbr}\n", "red");
                       continue;
                   }
                   $data = array('qtr40' => $line['qtr40']);
                   $this->getWellModel()->update($well->id, $data);
                   
                    echo $out->getColoredString("Updated Well {$well->id}\n", "green");
                    
                    ob_end_flush();
                    flush();
                    
                }
            }    
        }
        
        
    }
    
    public function checkAction ()
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit','1600M');
        
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        $wells = $this->getWellModel()->findAll();
        
        foreach ($wells as $well) {
            @ob_end_clean();
            ob_start();
            //echo 'Check well ' . $well->id . "\n";
            // set up search to check for duplicate
            $checkSearch = array(
                    'wl_county_code' => $well->wl_county_code,
                    'name_last' => $well->name_last,
                    'name_first' => $well->name_first,
                    'street_of_well' => $well->street_of_well,
                    'township' => $well->township,
                    'township_char' => $well->township_char,
                    'range' => $well->t_range,
                    'range_char' => $well->range_char,
                    'sctn' => $well->sctn
            )
            ;
            
            if ($well->name_last != "" && $well->name_first != "" &&
                     $well->street_of_well != "") {
                
                $checkWells = $this->getWellModel()->find($checkSearch);
                
                if (count($checkWells) > 1) {
                    echo 'found ' . count($checkWells) . ' duplicates of well ' .
                             $well->id . "\n";
                    
                    foreach ($checkWells as $checkWell) {
                        
                        if ($checkWell->id != $well->id) {
                            echo ' DELETE Name ' . $checkWell->name_first . ' ' .
                                     $checkWell->name_last . ' ' .
                                     $checkWell->street_of_well . "\n";
                            
                            $this->getWellModel()->delete($checkWell->id);
                        }
                    }
                }
            }
            ob_end_flush();
        }
    }
    
    public function emptyAction()
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit','1600M');
        
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
       $wells = $this->getWellModel()->findEmpty();
       
       foreach($wells as $well) {
          $this->getWellModel()->delete($well['id']);
       }
       
    }
    
     
    /** done **/
    public function geocodeAction()
    {
        $errorCount = 0;
        
        $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH .'/log/geocode.txt');
        
        $log    = new Zend_Log($writer);
        
        $out = new Application_Model_Colors();
        
        ini_set('max_execution_time', 0);
        ini_set('memory_limit','1600M');
        
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
        $key = "Fmjtd%7Cluur20u729%2C20%3Do5-9aynh4";
       
        $url =  "http://www.mapquestapi.com/geocoding/v1/address?key=" .$key;
        $blmUrl = "http://www.geocommunicator.gov/TownshipGeocoder/TownshipGeocoder.asmx/GetLatLon?TRS=";
        
        $client = new Zend_Http_Client();
        
        
        $wells = $this->getWellModel()->findAll();
        foreach($wells as $well) {
            @ob_end_clean();
            ob_start();
            
            $townshipString = "OR,33," . $well->township . ",0,".$well->township_char.",".$well->t_range.",0,".$well->range_char.",".$well->sctn.",".$well->qtr160.$well->qtr160.",0";
            
            // dumb ass state sometimes puts city and state in the field
            $pieces = explode(",", $well->street_of_well);
            $wellStreet = $pieces[0];
            if(empty($wellStreet)) {
                $wellStreet = $well->street_of_well;
            }
            
            
            $ownerStreet = $well->street;
            $ownerCity = $well->city;
            $ownerZip = $well->zip;
            
            //echo $townshipString ."\n";
            
            // first check if we have any street
            if(empty($ownerStreet) && empty($wellStreet)) {
                echo $out->getColoredString("We have no address to look up. Use TRS data to set lat and lng\n", "red", "black");    
                    $xml = simplexml_load_file($blmUrl.$townshipString);  
                   
                    if($xml->Message == "Ok") {
                        
                        $data = $xml->Data;
                        $xml=simplexml_load_string($data);
                        $pieces = explode(",",$xml->channel->item->description);
                        $lat =  str_replace(")", "", $pieces[0]);
                        $lat =  str_replace("Latitude(", "", $lat);
                        $lng =  str_replace(")", "", $pieces[1]);
                        $lng =  str_replace(" Longitude(", "", $lng);
                        
                        // ok now we can look up using mapquest and see if we can get any info.
                        $xml = simplexml_load_file($url."&callback=renderReverse&location=$lat,$lng&outFormat=xml");
                       
                        if($xml->info->statusCode == 0) {
                            $location = $xml->results->result->locations->location;
                           
                            $street = $location->street;
                            $city = $location->adminArea5;
                            $zip = $location->postalCode;
                            
                            $data = array(
                            	'street' => $street,
                                'city' => $city,
                                'zip' => $zip,
                                'street_of_well' => $street,
                                'city_of_well' => $city,
                                'zip_of_well' => $zip,
                                'address' => $street . " " . $city . ", or ". $zip,
                                'longitude' => $lng,
                                'latitude' => $lat,
                                'check_lat' => 1
                            );
                            $this->getWellModel()->update($well->id, $data);
                            echo $out->getColoredString("Saved Well data " . $well->id . " \n", "green", "black");
                            continue;
                        } else {
                            // failed
                            echo $out->getColoredString("Failed to get xml from Mapquest {$xml->info->message}\n", "red", "black");
                            // mark as failed
                            $data = array(
                                    'lat_fail' => 1,
                            );
                            $this->getWellModel()->update($well->id, $data);
                            $log->info("[{$well->id}] Failed to get xml from Mapquest {$xml->info->message} for well");
                            continue;
                        }
                    } else {
                        echo $out->getColoredString("Failed to get xml from BLM {$xml->Message}\n", "red", "black");
                        // mark as failed
                        $data = array(
                        	'lat_fail' => 1,
                        );  
                        $this->getWellModel()->update($well->id, $data);
                        $log->info("[{$well->id}] Failed to get xml from BLM {$xml->Message} for well");
                        $errorCount++;
                    }
                
            } else {
                
                //check if owner street matches well street
                if($wellStreet == $ownerStreet) {
                    echo $out->getColoredString("Well ".$well->id." street matches owner street skipping\n", "green", "black");
                    $street = $wellStreet;
                    $city = $ownerCity;
                    $zip = $ownerZip;
                    
                    $searchString = $street . " " . $city .", or " . $zip;
                    // update the well 
                    $data = array(
                    	'city_of_well' => $city,
                        'zip_of_well' => $zip,
                        'address' => $searchString,
                        'check_lat' => 1    
                    );
                    $this->getWellModel()->update($well->id, $data);
                    // we are done with this log next
                    continue;
                } else {
                    $string = "Well ".$well->id." Owner Street does not match Well Street " . $ownerStreet . " == " . $wellStreet . "\n";
                    echo $out->getColoredString($string, "yellow", "black");
                    // we have something differnt and need to find correct address
                    
                    // start by looking up TRS data get LAT and LNG
                    $xml = simplexml_load_file($blmUrl.$townshipString);
                    if($xml->Message == "Ok") {
                    
                        $data = $xml->Data;
                        $xml=simplexml_load_string($data);
                        $pieces = explode(",",$xml->channel->item->description);
                        $lat =  str_replace(")", "", $pieces[0]);
                        $lat =  str_replace("Latitude(", "", $lat);
                        $lng =  str_replace(")", "", $pieces[1]);
                        $lng =  str_replace(" Longitude(", "", $lng);
                    
                        // ok now we can look up using mapquest and see if we can get any info.
                        $xml = simplexml_load_file($url."&callback=renderReverse&location=$lat,$lng&outFormat=xml");
                        if($xml->info->statusCode == 0) {
                            $location = $xml->results->result->locations->location;
                             
                            $city = $location->adminArea5;
                            $zip = $location->postalCode;
                            
                            
                            // check if well_street is empty and owner city matches what the BLM gave us then we can use owner address.
                            if($well->city == $city && empty($well->street_of_well)) {
                                // get lat lng
                                
                                $data = array(
                                	'street_of_well' => $well->street,
                                    'city_of_well' => $city,
                                    'zip_of_well' => $zip,
                                    'address' =>  $well->street ." " . $city .", " . $zip,
                                    'check_lat' => 1
                                );
                                $this->getWellModel()->update($well->id, $data);
                                echo $out->getColoredString("Saved address for well " .$well->id ."\n", "green");
                                continue;
                            }
                            
                            // now we look up exact address
                            $json='{"location":{"street": "'.$wellStreet.'","city":"'.$city.'","state":"OR","postalCode":"'.$zip.'"}}';
                          
                            $client->setConfig(array(
                                    'maxredirects' => 0,
                                    'timeout'      => 30));
                            
                            $client->setParameterGet(array(
                                    'inFormat' => 'json',
                                    'json'     => $json,
                                    'maxResults' => '1',
                            ));
                            
                            $client->setUri($url);
                            
                            $client->getLastRequest();
                            $response = $client->request();
                            $body = Zend_Json::decode($response->getBody(), Zend_Json::TYPE_OBJECT);
                             
                            $statusCode = $body->info->statuscode;
                            
                            
                            if($statusCode == 0) {
                                
                                $results = $body->results;
                                $lat = $results[0]->locations[0]->latLng->lat;
                                $lng = $results[0]->locations[0]->latLng->lng;
                                
                                $data = array(
                                	'city_of_well' => $city,
                                    'zip_of_well' => $zip,
                                    'address' => $well->street_of_well . " " .$city . ", or " . $zip,
                                    'longitude' => $lng,
                                    'latitude' => $lat,
                                    'check_lat' => 1,
                                );
                                
                                $this->getWellModel()->update($well->id, $data);
                               echo  $out->getColoredString('Saved address for well ' . $well->id . "\n", "green");
                            } else {
                              // falied to look up exact street
                              echo $out->getColoredString('Faled to look up extact addresss for well ' . $well->id . "\n", "red");
                              $data = array('lat_fail' => 1);
                              $this->getWellModel()->update($well->id, $data);
                              $log->info("[{$well->id}] Failed to look up extact addresss for well");
                              $errorCount++;
                            }
                        } else {
                            // we failed to get data back from map quest.
                            echo $out->getColoredString('Faled to get data back from map quest for well ' . $well->id. "\n", "red");
                            $data = array('lat_fail' => 1);
                            $this->getWellModel()->update($well->id, $data);
                            $log->info("[{$well->id}] Faled to get data back from map quest for well");
                            $errorCount++;
                        }
                    } else {
                        // we failed to get data back from BLM
                        echo $out->getColoredString('Faled to get data back from BLM for well ' . $well->id. "\n", "red");
                        $data = array('lat_fail' => 1);
                        $this->getWellModel()->update($well->id, $data);
                        $log->info("[{$well->id}] Failed to get data back from BLM for well");
                        $errorCount++;
                    }                    
                }
            }
            
            if($errorCount > 20) {
                //$log->info("stoping to many errors");
                //exit;
            }
            
            //sleep(.5);
            ob_end_flush();
            flush();
        }
        
    }
    
    function csv_to_array ($filename = '', $delimiter = ',')
    {
        if (! file_exists($filename) || ! is_readable($filename))
            return FALSE;
        
        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if (! $header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
}