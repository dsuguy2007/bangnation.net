<?php

namespace Bangnation\ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Bangnation\ChatBundle\Entity\Chat;

class DefaultController extends Controller
{
    /**
     * @Route("/chat/heartbeat", name="chat_heartbeat", options={"expose"=true})
     * @Template()
     */
    public function heartbeatAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $chats = $this->getUser()->getIncomingChats();

        $items = array();
                
        foreach ($chats as $chat) {
            if (false === $chat->getReceived()) {
                if (!isset($_SESSION['openChatBoxes'][$chat->getSourceUser()->getUsername()]) && isset($_SESSION['chatHistory'][$chat->getSourceUser()->getUsername()])) {
                    $items = $_SESSION['chatHistory'][$chat['from']];
		}
                
                $items[] = array(
                    's' => '0',
                    'f' => "{$chat->getSourceUser()->getUsername()}",
                    'm' => "{$chat->getMessage()}",
                );
                
                unset($_SESSION['tsChatBoxes'][$chat->getSourceUser()->getUsername()]);
		$_SESSION['openChatBoxes'][$chat->getSourceUser()->getUsername()] = $chat->getSent();
            }
            
            if (!empty($_SESSION['openChatBoxes'])) {
                foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
                    if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
                        if (is_object($time)) {
                            $now = time() - strtotime($time->format('g:iA M dS'));
                            $time = $time->format('g:iA M dS');

                            $message = "Sent at $time";
                            if ($now > 180) {
                                $items[] = array(
                                    's' => '2',
                                    'f' => "$chatbox",
                                    'm' => "{$message}"
                                );

                                $_SESSION['tsChatBoxes'][$chatbox] = 1;
                            }
                        }
                    }
                }
            }

            $chat->setReceived(true);
            
            $em->persist($chat);
            $em->flush($chat);
        }
        
        $data = array(
            'items' => $items,
        );
        
        return new Response(json_encode($data));
    }
    
    private function chatBoxSession($chatbox) {

            $items = '';

            if (isset($_SESSION['chatHistory'][$chatbox])) {
                    $items = $_SESSION['chatHistory'][$chatbox];
            }

            return $items;
    }
    
    /**
     * @Route("/chat/startsession", name="chat_startsession", options={"expose"=true})
     * @Template()
     */
    public function startSessionAction() {
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= $this->chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

        $data = array(
            'username' => $this->getUser()->getUsername(),
            'items' => array(
                $items
            )
        );
     
        return new Response(json_encode($data));
    }
    
    /**
     * @Route("/chat/send", name="chat_send", options={"expose"=true})
     * @Template()
     */
    public function sendAction() {
        $em = $this->getDoctrine()->getEntityManager();
        
            $to = $_POST['to'];
            $message = $_POST['message'];

            $_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());

            $messagesan = $this->sanitize($message);

            if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
                    $_SESSION['chatHistory'][$_POST['to']] = '';
            }

//            $_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
//                                               {
//                            "s": "1",
//                            "f": "{$to}",
//                            "m": "{$messagesan}"
//               },
//            EOD;


            unset($_SESSION['tsChatBoxes'][$_POST['to']]);

            $targetUser = $em->getRepository('BangnationUserBundle:User')->findOneByUsername($to);
     
            $chat = new Chat();
            $chat->setSourceUser($this->getUser());
            $chat->setTargetUser($targetUser);
            $chat->setMessage($message);
            $chat->setSent(new \DateTime("now"));
            $chat->setReceived(false);
            
            $em->persist($chat);
            $em->flush($chat);
            
//            $sql = "insert into chat (chat.from,chat.to,message,sent) values ('".mysql_real_escape_string($from)."', '".mysql_real_escape_string($to)."','".mysql_real_escape_string($message)."',NOW())";
//            $query = mysql_query($sql);
            
            return new Response("1");
    }

    /**
     * @Route("/chat/close", name="chat_close", options={"expose"=true})
     * @Template()
     */
    public function closeAction() {

            unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);

            return new Response("1");
    }

    private function sanitize($text) {
            $text = htmlspecialchars($text, ENT_QUOTES);
            $text = str_replace("\n\r","\n",$text);
            $text = str_replace("\r\n","\n",$text);
            $text = str_replace("\n","<br>",$text);
            
            return $text;
    }
}
