<?php
/*
 *      grab_urls.php
 *      Adapted by caprenter <caprenter@gmail.com> from: 
 * 
 *      Copyright 2012 caprenter <caprenter@gmail.com>
 *      
 *      This file is part of IATI Registry Refresher.
 *      
 *      IATI Registry Refresher is free software: you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation, either version 3 of the License, or
 *      (at your option) any later version.
 *      
 *      IATI Registry Refresher is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with IATI Registry Refresher.  If not, see <http://www.gnu.org/licenses/>.
 * 
 *      IATI Registry Refresher relies on other free software products. See the README.txt file 
 *      for more details.
 */

/* Note
 * For this script to work you may need to create the following directories
 * and make then writable: 
 * ./ckan
 * ./urls
 * ./data
 * ./logos
*/

// Display errors for demo
//@ini_set('error_reporting', E_ALL);
//@ini_set('display_errors', 'stdout');
  
/* Function to perform an API request against the 360 Registry CKAN v3 API
 * http://docs.ckan.org/en/latest/api/index.html
 *
 * name: api_request
 * @param $path string  The final part of the api CKAN
 * @param $data array   Key value pairs of post data parameters for the api call
 * @param $ckan_file string Where to save the results of the api call 
 * @return PHP Object of the call to the api result
 * 
 */

function api_request($path, $data=null, $ckan_file=null) {
    $api_root = "http://data.threesixtygiving.org/api/3/";

    if ($data === null) $data_string = '{}';
    else $data_string = json_encode($data);

    $ch = curl_init($api_root.$path);
    //echo $ch;
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: '.strlen($data_string))
    );
    
    // Try up to 5 times if we get a 500 error.
    for ($i=0; $i<5; $i++) {
        $result = curl_exec($ch);
        //print_r(curl_getinfo($ch));
        if (curl_getinfo($ch)['http_code'] == 500) {
            // Wait a second before we retry
            sleep(1);
        }
        else {
            break;
        }
    }
    //print_r($result);
    curl_close($ch);

    if ($ckan_file !== null) {
        //echo "Saving file ";
        // Save CKAN json from the API call to a file
        file_put_contents($ckan_file, $result, LOCK_EX);
    }

    return json_decode($result)->result;
}
  
//Empty variables    
$urls = array();

//Pull all the group identifiers from the registry
//We store them in an array , $groups, for later use
$groups = api_request('action/group_list');
//print_r($groups);
//Overide the group array, e.g. for testing. Uncomment and edit the line(s) below
//$groups = array("sport-england");


//Loop through each group and save the URL end-points of the data files
//You may need to set up an empty directory called "urls"
//echo "Fetching:" . PHP_EOL;
foreach ($groups as $group) {
    //Work out where to save the results
    if (isset($dir)) { // will be set if called from wordpress. Not if run directly
      $file = $dir . "/urls/" . $group;
      $logo_file = $dir . "/logos/" . $group;
      $ckan_file = $dir . "/ckan/" . $group;
    } else {
      $file = "urls/" . $group;
      $logo_file = "logos/" . $group;
      $ckan_file = "ckan/" . $group;
    }
   // echo $group."\n";
    try {
        $urls_string = '';
        $result = api_request('action/group_package_show?id=' . $group, null, $ckan_file);
        //print_r($result); //die;
        foreach ($result as $package) {
          //print_r($package);
            try {
                $urls_string .= $package->name . ' ' . (string)$package->resources[0]->url . PHP_EOL;
                //Save the logo
                if ($package->groups[0]->image_display_url) {
                  $logo_link = $package->groups[0]->image_display_url;
                  //Find the extension of the logo image from it's url 
                  $extension = explode('/', $logo_link); //split into path components
                  $extension = array_pop($extension); // grab the last part of the path
                  $extension = explode('.', $extension); // split into values seperated by .'s
                  $extension = array_pop($extension); // get the last one. This should be e.g. jpg
                  //print_r($extension); die;
                  file_put_contents($logo_file . '.' . $extension,file_get_contents($logo_link), LOCK_EX);
                }
            } catch (Exception $e) {
                // Catch exceptions here to prevent one url from breaking an entire publisher
                print 'Caught exception in '.$file.': ' . $e->getMessage();
            }
        }
        file_put_contents($file, $urls_string, LOCK_EX);
    } catch (Exception $e) {
        print 'Caught exception in '.$file.': ' . $e->getMessage();
    }
}

?>

