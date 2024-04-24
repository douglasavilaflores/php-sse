<?php

use Source\Models\Message;

date_default_timezone_set("America/Sao_Paulo");
header("Cache-Control: no-store");
header("Content-Type: text/event-stream");

require dirname(__DIR__, 3) . "/vendor/autoload.php";

/**
 * Criando enlace
 */
stream("conn", 0, "test", 1);
stream("conn", 0, "connected", 1);

while (true) {
	getMessage();
	if (connection_aborted()) {
		break;
	}
	sleep(1);
}

/**
 * getMessage function
 *
 * @return void
 */
function getMessage(): void
{
	$message = (new Message())->find("sent = :sent", "sent=n")->limit(1)->fetch();
	if ($message) {
		/**
		 * Faço um ping para verificar se posso enviar a mensagem
		 */
		stream("ping", 0, "ok", 1);
		if (connection_aborted()) {
			exit;
		}
		/**
		 * Efetivo o envio da mensgem
		 */
		stream("test", $message->id, $message->message);
		if (!connection_aborted()) {
			markMessageAsSent($message);
		}
	}
}

/**
 * markMessageAsSent function
 *
 * @param Message $mensagem
 * @return void
 */
function markMessageAsSent(Message $mensagem): void
{
	$mensagem->sent = 'y';
	$mensagem->save();
}

/**
 * stream function
 *
 * @param string $event
 * @param integer $id
 * @param mixed $message
 * @param integer $retry
 * @return void
 */
function stream(string $event, int $id, mixed $message, int $retry = 5000): void
{
	echo "event: {$event}\n";
	echo "id: {$id}\n";
	echo "data: {$message}\n";
	echo "retry: {$retry}\n\n";
	if (ob_get_contents()) {
		ob_end_clean();
	}
	flush();
}
