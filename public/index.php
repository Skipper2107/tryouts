<?php
require_once '../vendor/autoload.php';

use App\Dijkstra\Dijkstra;
use App\Dijkstra\Map;
use App\Evklid\Evklid;
use App\Minesweeper\Field;
use App\NeuralNetwork\Input;
use App\NeuralNetwork\NeuralNetwork;
use App\RSA\RSA;

//$field = Field::generate(3,3,3);
//$field->open(0,1);
//ddd($field);

//$decoder = new RSA();
//
//$data = $decoder->encrypt(89);
//$decoded = $decoder->decrypt($data['data'], $data['openKey'], $data['control']);
//ddd($data, $decoded);
//$net = new NeuralNetwork('Is this girl cute?');
//$net->addInput( (new Input())->setInput('eyes', 2/** green */, 2/** its pretty cool */) );
//$net->addInput( (new Input())->setInput('boobs', 4 /** whooaa, awesome dude */, 5 /** its goddamn important */) );
//$net->addInput( (new Input())->setInput('booty', 2 /** nice, round butt */, 4 /** not bad */) );
//$net->addInput( (new Input())->setInput('high', 1.50 /** short, nice, my type */, 6 /** this is main criteria */) );
//$net->createNeurons(500);
//$net->work();
//$net->getOutput();


//$map = new Map();
//
//$map->addRoute('first', 'fourth', 12);
//$map->addRoute('fourth', 'first', 12);
//
//$map->addRoute('first', 'fifth', 15);
//$map->addRoute('fifth', 'first', 15);
//
//$map->addRoute('fourth', 'fifth', 2);
//$map->addRoute('fifth', 'fourth', 2);
//
//$map->addRoute('fifth', 'second', 5);
//$map->addRoute('second', 'fifth', 5);
//
//$map->addRoute('second', 'third', 5);
//$map->addRoute('third', 'second', 5);
//
//$map->addRoute('third', 'sixth', 5);
//$map->addRoute('sixth', 'third', 5);
//
//$map->addRoute('sixth', 'fourth', 5);
//$map->addRoute('fourth', 'sixth', 5);
//
////$map->addRoute('second', 'sixth', 3);
////$map->addRoute('sixth', 'second', 3);
//
//$alg = new Dijkstra($map);
//$alg->mapWay('first');
//sd( $alg->getRouteTo('third') );