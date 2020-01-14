<?php

namespace App\Http\Controllers\Api\Temp;

use App\AddrInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class Temp5Controller extends Controller
{
    public  function  SendMail(Request $request)
    {
        $wdh = $request->wdh;
        $mailRaw = "您好，赵经理，我是宇峰的监控台，发现有税务串号， 请立刻联系仓库， 检查网单号为：";
        $mailRaw .= $wdh;
        $mailRaw .= "比对药师帮下单的客户和仓库即将发货的客户是否一致，防止该货物发出!";
        Mail::raw($mailRaw, function ($message) {
            $to = '405177616@qq.com';
            $message
                ->to($to)
                ->subject('江苏金石医药有限公司-监控台')
                ->cc(['345108530@qq.com','1007954344@qq.com']);
        });
        return "发送邮件";
    }
}
