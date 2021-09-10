<?php

namespace TelegramBot;

/**
 * @author Incognito Coder
 * @copyright 2020-2021 ICDev
 * @version 1.2.0
 */
class ICBot
{
    private $Data = [];
    private $Array = [];

    public function __construct()
    {
        $this->Data = $this->Update();
    }

    /**
     * @param string $Token Your Bot API-KEY, Get It From @BotFather
     */
    public function Initialize($Token)
    {
        define('API_KEY', $Token);
        function BOT($Method, $Data = [])
        {
            $url = "https://api.telegram.org/bot" . API_KEY . "/" . $Method;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $Data);
            $res = curl_exec($ch);
            if (curl_error($ch)) {
                var_dump(curl_error($ch));
            } else {
                return json_decode($res);
            }
        }
    }

    /**
     * @param mixed $chat Target ChatID.
     * @param string $text Body of Message To Send.
     * @param string $parse Must be HTML or MarkDown (Optional)
     * @param boolean $preview Disables link previews for links in this message (Optional)
     * @param boolean $notification Sends the message silently. Users will receive a notification with no sound (Optional)
     * @param integer $reply If the message is a reply, ID of the original message (Optional)
     * @param mixed $keyboard Put Variable or Leave It Null (Optional)
     */
    function SendMessage($chat, $text, $parse = null, $preview = null, $notification = null, $reply = null, $keyboard = null)
    {
        BOT('sendMessage', [
            'chat_id' => $chat,
            'text' => $text,
            'parse_mode' => $parse,
            'disable_web_page_preview' => $preview,
            'disable_notification' => $notification,
            'reply_to_message_id' => $reply,
            'reply_markup' => $keyboard,
        ]);
    }

    /**
     * @param mixed $chat Target ChatID.
     * @param int $msgid ID of Message.
     * @param string $text Body of Message To Send.
     * @param boolean $parse Must be HTML or MarkDown (Optional)
     * @param null $keyboard Put Variable or Leave It Null (Optional)
     */
    function EditMessage($chat, $msgid, $text, $parse, $keyboard = null)
    {
        BOT('editMessageText', [
            'chat_id' => $chat,
            'message_id' => $msgid,
            'text' => $text,
            'parse_mode' => $parse,
            'reply_markup' => $keyboard
        ]);
    }

    /**
     * @param mixed $chat Target ChatID.
     * @param string $file Photo To Send.
     * @param string $caption Some Details About Image (Optional)
     * @param string $parse Must be HTML or MarkDown (Optional)
     * @param boolean $notification Sends the message silently. Users will receive a notification with no sound (Optional)
     * @param integer $reply If the message is a reply, ID of the original message (Optional)
     * @param mixed $keyboard Put Variable or Leave It Null (Optional)
     */
    function SendPhoto($chat, $file, $caption = null, $parse = null, $notification = null, $reply = null, $keyboard = null)
    {
        BOT('sendPhoto', [
            'chat_id' => $chat,
            'photo' => $file,
            'caption' => $caption,
            'parse_mode' => $parse,
            'disable_notification' => $notification,
            'reply_to_message_id' => $reply,
            'reply_markup' => $keyboard
        ]);
    }

    /**
     * @param mixed $chat Target ChatID.
     * @param string $file Video To Send.
     * @param string $caption Some Details About Video (Optional)
     * @param string $parse Must be HTML or MarkDown (Optional)
     * @param boolean $notification Sends the message silently. Users will receive a notification with no sound (Optional)
     * @param integer $reply If the message is a reply, ID of the original message (Optional)
     * @param mixed $keyboard Put Variable or Leave It Null (Optional)
     */
    function SendVideo($chat, $file, $caption = null, $parse = null, $notification = null, $reply = null, $keyboard = null)
    {
        BOT('sendVideo', [
            'chat_id' => $chat,
            'video' => $file,
            'caption' => $caption,
            'parse_mode' => $parse,
            'disable_notification' => $notification,
            'reply_to_message_id' => $reply,
            'reply_markup' => $keyboard
        ]);
    }

    /**
     * @param mixed $chat Target ChatID.
     * @param string $file Music To Send.
     * @param string $caption Some Details About Audio (Optional)
     * @param string $parse Must be HTML or MarkDown (Optional)
     * @param integer $duration Duration of the audio in seconds (Optional)
     * @param string $performer Performer (Optional)
     * @param string $title Track name (Optional)
     * @param string $thumb Thumbnail of the file sent (Optional)
     * @param boolean $notification Sends the message silently. Users will receive a notification with no sound (Optional)
     * @param integer $reply If the message is a reply, ID of the original message (Optional)
     * @param mixed $keyboard Put Variable or Leave It Null (Optional)
     */
    function SendAudio($chat, $file, $caption = null, $parse = null, $duration = null, $performer = null, $title = null, $thumb = null, $notification = null, $reply = null, $keyboard = null)
    {
        BOT('sendAudio', [
            'chat_id' => $chat,
            'audio' => $file,
            'caption' => $caption,
            'parse_mode' => $parse,
            'duration' => $duration,
            'title' => $title,
            'thumb' => $thumb,
            'performer' => $performer,
            'disable_notification' => $notification,
            'reply_to_message_id' => $reply,
            'reply_markup' => $keyboard
        ]);
    }

    /**
     * @param mixed $chat Target ChatID.
     * @param string $file Document To Send.
     * @param string $caption Some Details About File (Optional)
     * @param string $parse Must be HTML or MarkDown (Optional)
     * @param string $thumb Mini Image For File(Optional)
     * @param boolean $notification Sends the message silently. Users will receive a notification with no sound (Optional)
     * @param integer $reply If the message is a reply, ID of the original message (Optional)
     * @param mixed $keyboard Put Variable or Leave It Null (Optional)
     */
    function SendDocument($chat, $file, $caption = null, $parse = null, $thumb = null, $notification = null, $reply = null, $keyboard = null)
    {
        BOT('sendDocument', [
            'chat_id' => $chat,
            'document' => $file,
            'thumb' => $thumb,
            'caption' => $caption,
            'parse_mode' => $parse,
            'disable_notification' => $notification,
            'reply_to_message_id' => $reply,
            'reply_markup' => $keyboard
        ]);
    }

    /**
     * @param mixed $chat Target ChatID.
     * @param mixed $from Forward Message From ChatID.
     * @param mixed $msgid Desired Message ID.
     */
    function ForwardMessage($chat, $from, $msgid)
    {
        BOT('ForwardMessage', [
            'chat_id' => $chat,
            'from_chat_id' => $from,
            'message_id' => $msgid
        ]);
    }

    /**
     * @param string $text Enter Button Text.
     * @param string $url Link You Want To Be Open.
     */
    public function InlineKeyboard($text, $url)
    {
        return json_encode(['inline_keyboard' => [[['text' => $text, 'url' => $url]]], 'resize_keyboard' => true]);
    }

    /**
     * @param string $data Enter Buttons And Links As Json.
     */
    public function MultiInlineKeyboard($json)
    {
        return json_encode(['inline_keyboard' => $json, 'resize_keyboard' => true]);
    }

    /**
     * @param string $text Enter Button Text.
     */
    public function Keyboard($text)
    {
        return json_encode(['keyboard' => [[['text' => $text]]], 'resize_keyboard' => true]);
    }

    /**
     * @param string $data Enter Buttons As Json.
     */
    public function MultiKeyboard($json)
    {
        return json_encode(['keyboard' => $json, 'resize_keyboard' => true]);
    }

    public function Update()
    {
        if (empty($this->Data)) {
            $update = file_get_contents('php://input');
            return json_decode($update, true);
        } else {
            return $this->Data;
        }
    }

    /**
     * @meta Return Current ChatID.
     */
    public function GetChatID()
    {
        return $this->Data['message']['chat']['id'];
    }

    /**
     * @meta Get Message of User.
     */
    public function GetText()
    {
        return $this->Data['message']['text'];
    }

    /**
     * @meta Get Caption of Message.
     */
    public function GetCaption()
    {
        return $this->Data['message']['caption'];
    }

    /**
     * @meta Get Current User Username.
     */
    public function GetUsername()
    {
        return $this->Data['message']['from']['username'];
    }

    /**
     * @meta Get Current User Firstname.
     */
    public function GetFirstname()
    {
        return $this->Data['message']['from']['first_name'];
    }

    /**
     * @meta Return ID of Last Received Message.
     */
    public function MessageID()
    {
        return $this->Data['message']['message_id'];
    }

    /**
     * @meta Return Current Chat Username.
     */
    public function GetChatUser()
    {
        return $this->Data['message']['chat']['username'];
    }

    /**
     * @meta Return Chat Type.
     */
    public function ChatType()
    {
        return $this->Data['message']['chat']['type'];
    }

    /**
     * @meta Return user ChatID.
     */
    public function FromID()
    {
        return $this->Data['message']['from']['id'];
    }

    /**
     * @meta Return Current Chat Name.
     */
    public function ChatTitle()
    {
        return $this->Data['message']['chat']['title'];
    }

    /**
     * @meta Check Is User Joined On Desired Chat.
     * @param string $chatid Fill With (username,id).
     * @param string $userid Enter UserID.
     */
    function GetChatMember($chatid, $userid)
    {
        $check = json_decode(file_get_contents('https://api.telegram.org/bot' . API_KEY . "/getChatMember?chat_id=$chatid&user_id=" . $userid))->result->status;
        return $check;
    }

    const TEXT = 'text';
    const PHOTO = 'photo';
    const VIDEO = 'video';
    const DOCUMENT = 'document';
    const AUDIO = 'music';

    /**
     * @meta Return Update Type.
     */
    public function MessageType()
    {
        if (isset($this->Data['message']['text'])) {
            return self::TEXT;
        }
        if (isset($this->Data['message']['photo'])) {
            return self::PHOTO;
        }
        if (isset($this->Data['message']['video'])) {
            return self::VIDEO;
        }
        if (isset($this->Data['message']['audio'])) {
            return self::AUDIO;
        }
        if (isset($this->Data['message']['document'])) {
            return self::DOCUMENT;
        }
    }

    /**
     * @meta Return Current FileID.
     * @param string $type Fill With (photo,video,audio,document).
     */
    public function GetFileID($type)
    {
        switch ($type) {
            case 'photo';
                $new = $this->Data['message']['photo'][0]['file_id'];
                break;
            case 'video';
                $new = $this->Data['message']['video']['file_id'];
                break;
            case 'audio';
                $new = $this->Data['message']['audio']['file_id'];
                break;
            case 'document';
                $new = $this->Data['message']['document']['file_id'];
                break;
        }
        return $new;
    }

    /**
     * @param string $file_id Your FileID Stored On Telegram Servers.
     */
    public function GetFile($file_id)
    {

        $this->Array = get_defined_vars();
        $download = json_decode(file_get_contents('https://api.telegram.org/bot' . API_KEY . '/getFile?file_id=' . $file_id), true);
        return $download;
    }

    /**
     * @meta Return Current FileID.
     * @param string $param Fill With (path,id,unique,size).
     */
    public function FileOptions($param)
    {
        $return = $this->GetFile($this->Array["file_id"]);
        switch ($param) {
            case 'path';
                $new = $return['result']['file_path'];
                break;
            case 'id';
                $new = $return['result']['file_id'];
                break;
            case 'unique';
                $new = $return['result']['file_unique_id'];
                break;
            case 'size';
                $new = $return['result']['file_size'];
                break;
        }
        $result = 'https://api.telegram.org/file/bot' . API_KEY . '/' . $new;
        return $result;
    }

    /**
     * @meta Return Music Details.
     * @param string $value Fill With (title,artist,mime,thumb,size).
     */
    public function Music($value)
    {
        switch ($value) {
            case 'title';
                $new = $this->Data['message']['audio']['title'];
                break;
            case 'artist';
                $new = $this->Data['message']['audio']['performer'];
                break;
            case 'mime';
                $new = $this->Data['message']['audio']['mime_type'];
                break;
            case 'thumb';
                $new = $this->Data['message']['audio']['thumb'];
                break;
            case 'size';
                $new = $this->Data['message']['audio']['file_size'];
                break;
        }
        return $new;
    }

    /**
     * @meta Return CallBack Details.
     * @param string $select Fill With (id,data,chatid,msgid).
     * @return mixed
     */
    public function CallBackQuery($select)
    {
        switch ($select) {
            case 'id';
                $return = $this->Data['callback_query']['id'];
                break;
            case 'data';
                $return = $this->Data['callback_query']['data'];
                break;
            case 'chatid';
                $return = $this->Data['callback_query']['message']['chat']['id'];
                break;
            case 'msgid';
                $return = $this->Data['callback_query']['message']['message_id'];
                break;
        }
        return $return;
    }

    /**
     * @meta Return InlineQuery Details.
     * @param string $select Fill With (id,query).
     * @return mixed
     */
    public function InlineQuery($select)
    {
        switch ($select) {
            case 'id';
                $return = $this->Data['inline_query']['id'];
                break;
            case 'query';
                $return = $this->Data['inline_query']['query'];
                break;
        }
        return $return;
    }

    const CALLBACK_QUERY = 'callback_query';
    const INLINE_QUERY = 'inline_query';

    /**
     * @return string Updates Type ['callback_query','inline_query'].
     */
    public function GetUpdateType()
    {
        if (isset($this->Data['callback_query'])) {
            return self::CALLBACK_QUERY;
        }
        if (isset($this->Data['inline_query'])) {
            return self::INLINE_QUERY;
        }
    }

    /**
     * @param mixed $callbackid Put CallBack ChatID
     * @param string $text Write Message Body.
     * @param boolean $alert Show Alert Dialog.
     */
    function AnswerCallback($callbackid, $text, $alert = false)
    {
        BOT('answerCallbackQuery', [
            'callback_query_id' => $callbackid,
            'text' => $text,
            'show_alert' => $alert
        ]);
    }

    /**
     * @param mixed $id Put inlineQuery ID.
     * @param mixed $json Result As json.
     */
    function AnswerInline($id, $json)
    {
        BOT('answerInlineQuery', [
            'cache_time' => 0,
            'inline_query_id' => $id,
            'results' => json_encode($json)
        ]);
    }
}
