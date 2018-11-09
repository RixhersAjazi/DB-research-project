<?php
require_once __DIR__ . 'autoload.php';

if ($_SERVER['REQUEST_URI'] === '/api/user/create') {
	require_once __DIR__ . '/api/user/create.php';
	main(JsonDataObject::getData());
} else if ($_SERVER['REQUEST_URI'] === '/api/user/get') {
	require_once __DIR__ . '/api/user/get.php';
	main($_GET['userId']);
} else if ($_SERVER['REQUEST_URI'] === '/api/research/create') {
	require_once __DIR__ . '/api/research/create.php';
	main(JsonDataObject::getData());
} else if ($_SERVER['REQUEST_URI'] === '/api/research/get') {
	require_once __DIR__ . '/api/research/get.php';
	main($_GET['researchId']);
} else if ($_SERVER['REQUEST_URI'] === '/api/user/assignStudent') {
	require_once __DIR__ . '/api/user/assignStudent.php';
	main($_GET['researchId']);
} else if ($_SERVER['REQUEST_URI'] === '/api/research/getAll') {
	require_once __DIR__ . '/api/research/getAll.php';
	main();
} else if ($_SERVER['REQUEST_URI'] === '/api/user/getStudent') {
	require_once __DIR__ . '/api/user/getStudent.php';
	main();
}
