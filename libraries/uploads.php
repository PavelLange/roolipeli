<?php

function saveCampaignImage($file) {

    if (!isset($file) || $file["error"] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($file["error"] !== UPLOAD_ERR_OK) {
        return null;
    }

    if ($file["size"] > 2 * 1024 * 1024) {
        return null;
    }

    $info = getimagesize($file["tmp_name"]);
    if ($info === false) {
        return null;
    }

    $allowed = [
        IMAGETYPE_JPEG => ".jpg",
        IMAGETYPE_PNG  => ".png",
        IMAGETYPE_WEBP => ".webp",
    ];
    if (!isset($allowed[$info[2]])) {
        return null;
    }

    $filename = uniqid("campaign_") . $allowed[$info[2]];
    $diskPath = __DIR__ . "/../public/user-images/" . $filename;


    if (!move_uploaded_file($file["tmp_name"], $diskPath)) {
        return null;
    }

    return "/user-images/" . $filename;
}