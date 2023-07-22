<?php

// namespace-если кода много


/**
 * ПРЕДИСЛОВИЕ 
 * 
 * Данный код не является реальным испольнением API, т.к. построение выполнено крайне просто для экономии времени и ресурса, в реальности же должна быть
 * авторизация(в идеале OAuth 1/2), а также более сложные запросы curl_setopt
 * 
 * Я использую CURLOPT_SSL_VERIFYHOST(VERIFYPEER), 0, т.к. с мой браузер ругается на проблемы с сертификатом. В рабочем коде так делать нельзя никогда, 
 * т.к. грубейшее нарушение безопасности
 * 
 * В данном случае минимизация средняя, при желании можно сжать еще сильнее, но все зависит от требований компаний
 * 
 * Комментариев нет, т.к. код понятный(чистые функции), но если регламент предполагает их налчиие-оставлять их не проблема
 */

class UseApi
{

    private $urlQuery = 'https://jsonplaceholder.typicode.com';
    private $response;

    private function curlSetopts($ch)
    {
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    }

    private function checkExec($response, $ch)
    {
        $this->response = curl_exec($ch);
        if ($this->response === FALSE) {
            die(curl_error($ch));
            }
    
            curl_close($ch);
    }



    private function curlQueryGet($url){
        $ch = curl_init($url);
        $this->curlSetopts($ch);
        $this->checkExec($this->response, $ch);
        return $this->response = json_decode($this->response);
    }

    private function curlQueryPost($url, $data){
        $ch = curl_init($url);
        $this->curlSetopts($ch);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $this->checkExec($this->response, $ch);
        return $this->response = json_decode($this->response);
    }

    private function curlQueryPatch($url, $data){
        $ch = curl_init($url);
        $this->curlSetopts($ch);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $this->checkExec($this->response, $ch);
        return $this->response = json_decode($this->response);
    }

    private function curlQueryDelete($url){
        //в данном случае jsonplaceholder ничего не возвращает
        $ch = curl_init($url);
        $this->curlSetopts($ch);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $this->checkExec($this->response, $ch);
        return "Deleted";
    }



    //Можно было бы в users, userPosts и userTodos вставить слеши с параметрами через CURLOPT_URL, но для упрощения кода и экономии времени сделал так
    public function users()
    {
        $url = $this->urlQuery . '/users';
        return $this->curlQueryGet($url);
    }

    public function userPosts($userId)
    {
        $url = $this->urlQuery . '/posts' . '?userId=' . $userId;
        return $this->curlQueryGet($url);
    }

    public function userTodos($userId)
    {
        $url = $this->urlQuery . '/todos' . '?userId=' . $userId;
        return $this->curlQueryGet($url);
    }

    public function addPost($userId, $title, $body)
    {
        $data = [
            'userId' => $userId,
            'title' => $title,
            'body' => $body,
        ];
        $url = $this->urlQuery . '/posts';
        return $this->curlQueryPost($url, $data);
    }

    public function editPost($postId, $title, $body)
    {
        $data = [
            'title' => $title,
            'body' => $body,
        ];
        $url = $this->urlQuery . '/posts/' . $postId;
        return $this->curlQueryPatch($url, $data);
    }

    public function deletePost($postId)
    {
        $url = $this->urlQuery . '/posts/' . $postId;
        return $this->curlQueryDelete($url);
    }
}