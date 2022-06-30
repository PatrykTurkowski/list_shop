<?php

/**
 * Pages 
 */
class Pages extends Controller
{
    public function __construct()
    {
        $this->userTokenModel = $this->model('UserToken');
    }

    public function index(): void
    {
        $this->userTokenModel->create();
        $list = $this->userTokenModel->list();
        $data = [
            'title' => 'Home page',
            'list' => $list
        ];

        $this->view('/home/index', $data);
    }
}
