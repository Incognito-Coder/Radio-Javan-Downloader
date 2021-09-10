<?php

use RadioJavan\Downloader;
use TelegramBot\ICBot;

require_once('ICTelegramBot.php');
require_once('RJavan.php');

$RJ = new Downloader();
$BOT = new ICBot();
$BOT->Initialize('1469941905:AAFhDAFK9SI9xKmPg_kb_L0fJqAzpSWxtyU');
$ID = $BOT->GetChatID();
$TEXT = $BOT->GetText();
$MESSAGEID = $BOT->MessageID();
$NAME = $BOT->GetFirstname();
$RJ->Recognize($TEXT);
if (preg_match('/\/[Ss]tart/', $TEXT)) {
    $BOT->SendMessage($ID, "Hi,$NAME\nWelcome to Shayanify (Radio javan downloader).");
} elseif (preg_match('/\/[Aa]bout/', $TEXT)) {
    $BOT->SendMessage($ID, "By : Incognito Coder from @IC_Mods\nAlso join in @Shayanify channel\nGit Repo : https://github.com/Incognito-Coder/RadioJavan");
} elseif ($RJ->MediaType() == 'music') {
    $Download = $RJ->Download('music', $TEXT);
    $Result = json_decode($Download);
    $BOT->SendMessage($ID, "Title: <code>$Result->title</code>\nType : <b>Music</b>", 'html', true, null, $MESSAGEID, $BOT->InlineKeyboard('📥 Download 📥', $Result->result));
    $BOT->SendAudio($ID, $Result->result, 'Sent by @RJDLBOT');
} elseif ($RJ->MediaType() == 'podcast') {
    $Download = $RJ->Download('podcast', $TEXT);
    $Result = json_decode($Download);
    $BOT->SendMessage($ID, "Title: <code>$Result->title</code>\nType : <b>Podcast</b>", 'html', true, null, $MESSAGEID, $BOT->InlineKeyboard('📥 Download 📥', $Result->result));
} elseif ($RJ->MediaType() == 'video') {
    $Download = $RJ->Download('video', $TEXT);
    $Result = json_decode($Download);
    $BOT->SendMessage($ID, "Title: <code>$Result->title</code>\nType : <b>Music Video</b>", 'html', true, null, $MESSAGEID, $BOT->InlineKeyboard('📥 Download 📥', $Result->result));
}