<?php

/**
 * Neo4j Spatial Sample Code
 *
 * Example Geo Query: Geometries within distance -
 * http://neo4j-contrib.github.io/spatial/#rest-api-find-geometries-within--distance
 */
require_once './bootstrap.php';

use GuzzleHttp\Exception\RequestException;

try {
    $request = $client->createRequest(
        'POST',
        '/db/data/ext/SpatialPlugin/graphdb/findGeometriesWithinDistance',
        [
            'json' => [
                'layer' => 'geom',
                // Peabody Hotel
                // IMPORTANT: pointX is lon, pointY is lat
                'pointX' => -90.051506,
                'pointY' => 35.142260,
                'distanceInKm' => 10,
            ],
        ]
    );

    $response = $client->send($request);
    $data = $response->json();

    foreach ($data as $node) {
        d($node['data']['name']);
    }
} catch (RequestException $e) {
    d($e->getRequest());

    if ($e->hasResponse()) {
        d($e->getResponse());
        d($e->getResponse()->json());
    }
} catch (\Exception $e) {
    d($e->getMessage());
}
