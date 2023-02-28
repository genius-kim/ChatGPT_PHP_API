<?php
// 设置请求URL
$url = 'https://api.openai.com/v1/completions';

// 设置ChatGPT API密钥
$api_key = 'sk-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

//获取问题和key密钥(key密钥可以不要，看需求自定义)
$prompt = $_POST['question'];
$key = $_POST['key'];

// 设置请求参数
$data = array(
	// 使用ChatGPT的三号模型
    "model" => "text-davinci-003",
    "prompt" => $prompt,
    "temperature" => 0,
    "max_tokens" => 1000,
    "top_p" => 1,
    "frequency_penalty" => 0.0,
    "presence_penalty" => 0.0
);

// 设置请求头部
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $api_key,
);

// 发送POST请求
if ($key === '123456') {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);

    // 处理响应结果
    if ($response === false) {
        echo json_encode(array('status' => '405', 'msg' => "错误: 请求异常，请联系管理员检测ChatGPT是否正常!   ".$result));
    } else {
        $result = json_decode($response, true);
        if (isset($result['choices'][0]['text'])) {
            echo json_encode(array('status' => '200', 'msg' => $result['choices'][0]['text']));
        } else {
            echo json_encode(array('status' => '404', 'msg' => "错误: 请求异常，请联系管理员检测ChatGPT是否正常!   ".$result));
        }
    }
} else {
    echo json_encode(array('status' => '201', 'msg' => "错误: 异常非法请求！！！"));
}
