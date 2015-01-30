<?php

/**
 * Neo4j Spatial Sample Code
 *
 * Steps:
 *
 * 1. Create a pointlayer - http://neo4j-contrib.github.io/spatial/#rest-api-create-a-pointlayer
 * 2. Create a spatial index - http://neo4j-contrib.github.io/spatial/#rest-api-create-a-spatial-index
 * 3. Create a node with spatial data - http://neo4j-contrib.github.io/spatial/#rest-api-create-a-node-with-spatial-data
 * 4. Add a node to the spatial index - http://neo4j-contrib.github.io/spatial/#rest-api-add-a-node-to-the-spatial-index
 */
require_once './bootstrap.php';

use GuzzleHttp\Exception\RequestException;

try {
    // 1. Create a pointlayer
    $response = $client->post(
        '/db/data/ext/SpatialPlugin/graphdb/addSimplePointLayer',
        [
            'json' => [
                'layer' => 'geom',
                'lat' => 'lat',
                'lon' => 'lon',
            ],
        ]
    );
    d($response->json());

    // 2. Create a spatial index
    $response = $client->post(
        '/db/data/index/node/',
        [
            'json' => [
                'name' => 'geom',
                'config' => [
                    'provider' => 'spatial',
                    'geometry_type' => 'point',
                    'lat' => 'lat',
                    'lon' => 'lon',
                ],
            ],
        ]
    );
    d($response->json());

    // 3. Create a node (or nodes) with spatial data
    $graphStoryOffices = [
        'name' => 'Graph Story',
        'lat' => 35.121075,
        'lon' => -89.990630,
    ];

    $response = $client->post('/db/data/node', ['json' => $graphStoryOffices]);
    $data = $response->json();
    d($data);

    $graphStoryOfficesNode = $data['self'];

    $memphisPyramidArena = [
        'name' => 'Pyramid Arena',
        'lat' => 35.155917,
        'lon' => -90.051894,
    ];

    $response = $client->post('/db/data/node', ['json' => $memphisPyramidArena]);
    $data = $response->json();
    d($data);

    $memphisPyramidArenaNode = $data['self'];

    // 4. Add a node (or nodes) to the spatial index
    $response = $client->post(
        '/db/data/ext/SpatialPlugin/graphdb/addNodeToLayer',
        [
            'json' => [
                'layer' => 'geom',
                'node' => $graphStoryOfficesNode,
            ],
        ]
    );
    $data = $response->json();
    d($data);

    $response = $client->post(
        '/db/data/ext/SpatialPlugin/graphdb/addNodeToLayer',
        [
            'json' => [
                'layer' => 'geom',
                'node' => $memphisPyramidArenaNode,
            ],
        ]
    );
    $data = $response->json();
    d($data);
} catch (RequestException $e) {
    d($e->getRequest());

    if ($e->hasResponse()) {
        d($e->getResponse());
        d($e->getResponse()->json());
    }
} catch (\Exception $e) {
    d($e->getMessage());
}
