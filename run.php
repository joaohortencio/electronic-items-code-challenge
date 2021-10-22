<?php
require_once "bootstrap.php";

use Symfony\Component\Console\Application;

$application = new Application();

$application->addCommands(array(
    new App\RunTestsTerminalCommands(),
    new App\RunAnswersToQuestionsTerminalCommands()
));

try {
    $application->run();
} catch (Exception $e) {
    throw new Exception("Cannot run this application");
}