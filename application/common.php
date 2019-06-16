<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//把span字符替换成a
function replace($date){
    return str_replace('span','a',$date);
}
//邮件发送
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function mailto($to,$title,$content){

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;           // Enable verbose debug output
        $mail->CharSet='utf-8';
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.163.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '15528949706@163.com';                 // SMTP username
        $mail->Password = '76371660+.+';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('15528949706@163.com', '十清凉');
        $mail->addAddress($to);     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $content;

       return $mail->send();
    } catch (Exception $e) {
        exception($mail->ErrorInfo,'1001');
    }

}