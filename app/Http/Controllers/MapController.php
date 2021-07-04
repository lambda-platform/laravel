<?php

namespace App\Http\Controllers;

use Lambda\Datagrid\Datagrid;

define('EMPTY_REQUIRED_FIELD', 'Заавал оруулах талбар хоосон байна');
define('NOT_IN_DB', 'Сонголтонд байхгүй өгөгдөл байна');

class MapController extends Controller
{
    public function download($schemaID)
    {
        $barilgas = Datagrid::getAllData($schemaID);

        return $this->generatekml($barilgas);
    }

    public function generatekml($barilgas)
    {
        info('kml generated');

        // Creates an array of strings to hold the lines of the KML file.
        $kml = array('<?xml version="1.0" encoding="UTF-8"?>');
        $kml[] = '<kml xmlns="http://www.opengis.net/kml/2.2">';
        $kml[] = ' <Document>';
        // Iterates through the rows, printing a node for each row.
        foreach ($barilgas as $ads) {
            $kml[] = ' <Placemark id="placemark'.$ads->id.'">';
            $kml[] = ' <name>'.$ads->ner.'</name>';
            $kml[] = ' <description><![CDATA[
<table style="text-align:left;width:100%;border-spacing:0px; padding:3px 3px 3px 3px">
<tr>
<td>Нэр, дугаар</td>
<td>'.$ads->ner.'</td>
</tr>
<tr>
<td>Зориулалт</td>
<td>'.$ads->zoriulalt_ids.'</td>
</tr>
<tr bgcolor="#D4E4F3">
<td>Байршил</td>
<td>'.$ads->aimag_id.', '.$ads->sum_duureg_id.', '.$ads->bairshil.'</td>
</tr>
<tr bgcolor="#D4E4F3">
<td>Давхрын тоо</td>
<td>'.$ads->davhar_too.'</td>
</tr>
</table>
]]></description>';
            $kml[] = ' <Point>';
            $kml[] = ' <coordinates>'.$ads->longtitude.','.$ads->latitude.',0</coordinates>';
            $kml[] = ' </Point>';
            $kml[] = ' </Placemark>';
        }
        // End XML file
        $kml[] = ' </Document>';
        $kml[] = '</kml>';
        $kmlOutput = join("\n", $kml);

        return response()->json($kmlOutput);
    }

    public function generatekml1($barilgas)
    {
        info('kml generated');

        // Creates an array of strings to hold the lines of the KML file.
        $kml = array('<?xml version="1.0" encoding="UTF-8"?>');
        $kml[] = '<kml xmlns="http://earth.google.com/kml/2.1">';
        $kml[] = ' <Document>';
        $kml[] = ' <Style id="restaurantStyle">';
        $kml[] = ' <IconStyle id="restuarantIcon">';
        // $kml[] = ' <Icon>';
        // $kml[] = ' <href>http://maps.google.com/mapfiles/kml/pal2/icon63.png</href>';
        // $kml[] = ' </Icon>';
        $kml[] = ' </IconStyle>';
        $kml[] = ' </Style>';
        $kml[] = ' <Style id="barStyle">';
        $kml[] = ' <IconStyle id="barIcon">';
        $kml[] = ' <Icon>';
        $kml[] = ' <href>http://maps.google.com/mapfiles/kml/pal2/icon27.png</href>';
        $kml[] = ' </Icon>';
        $kml[] = ' </IconStyle>';
        $kml[] = ' </Style>';
        // Iterates through the rows, printing a node for each row.
//        while ($row = @mysql_fetch_assoc($result)) {
//        $adverts = Advertisement::all();
        foreach ($barilgas as $ads) {
            $kml[] = ' <Placemark id="placemark'.$ads->id.'">';
            $kml[] = ' <name>'.$ads->ner.'</name>';
            $kml[] = ' <description><![CDATA[
<table style="text-align:left;width:100%;border-spacing:0px; padding:3px 3px 3px 3px">
<tr>
<td>Нэр, дугаар</td>
<td>'.$ads->ner.'</td>
</tr>
<tr>
<td>Зориулалт</td>
<td>'.$ads->zoriulalt_ids.'</td>
</tr>
<tr bgcolor="#D4E4F3">
<td>Байршил</td>
<td>'.$ads->aimag_id.', '.$ads->sum_duureg_id.', '.$ads->bairshil.'</td>
</tr>
<tr bgcolor="#D4E4F3">
<td>Давхрын тоо</td>
<td>'.$ads->davhar_too.'</td>
</tr>
</table>
]]></description>';
            // $kml[] = ' <styleUrl>#restaurantStyle</styleUrl>';
            $kml[] = ' <Point>';
            $kml[] = ' <coordinates>'.$ads->longtitude.','.$ads->latitude.',0</coordinates>';
            $kml[] = ' </Point>';
            $kml[] = ' </Placemark>';
        }

//        }
        // End XML file
        $kml[] = ' </Document>';
        $kml[] = '</kml>';
        $kmlOutput = join("\n", $kml);

        return response()->json($kml);

        // $response = array(
        //     'name' => 'барилгын газрын зураг',
        //     'file' => 'data:application/vnd.google-earth.kml;base64,'.base64_encode($kmlOutput),
        // );

        // return response()->json($response);
    }
}
