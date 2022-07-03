<?php

/**
 * Cart - It's controller, here you can find all funcion where 
 * we use action with our cart.
 */
class Carts extends Controller
{
    /**
     * __construct - add model 
     *
     * @return void
     */
    public $token;
    public function __construct()
    {
        $this->cartModel = $this->model('Cart');
    }

    // public function index() {
    //     $data = [
    //         'title' => 'Home page'
    //     ];

    //     $this->view('home/index', $data);
    // }


    /**
     * create - Create new cart in database,
     * filter Sanitize for Garry ;),
     * Valid how much carts was created
     * redirect to page create
     * if error redirect main page 
     * @return void
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $countCarts = $this->cartModel->countCarts();
            if ($countCarts <= 10) {
               
                    $this->cartModel->create($_POST['cartName']);
                    $token = $this->cartModel->token;
                    $name = $_POST['cartName'];
                    $this->cartSession($name, $token);
                    $this->view('/cart/create', [
                        'title' => 'Create cart',
                        'token' => $token,
                        'name' => $name
                    ]);
            } else {
                $_SESSION['countCarts'] = 'You already have the maximum number of baskets';
                $this->show();
            }
        }
    }

    /**
     * findCart - This funcion search cart and 
     * redirect to cart 
     * @return void
     */
    public function findCart()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $token = $_POST['token'];

        if ($this->cartModel->isCart($token)) {
            $name = $this->cartModel->cartName($token);
            $this->cartSession($name, $token);
            $this->show();
        } else {
            header('location:' . URLROOT . 'home/index/');
            $_SESSION['errorMsg'] = 'This token do not exist';
        }
    }

    /**
     * cartSession - create session 
     * (we can create batter place for this function)
     *
     * @param  string $name
     * @param  string $token
     * @return void
     */
    public function cartSession($name, $token)
    {
        $_SESSION['cartName'] = $name;
        $_SESSION['token'] = $token;
    }


    /**
     * show - SELECT all products in single cart
     * show it in page cart
     * redirect cart
     * if error redirect main page
     * @return void
     */
    public function show()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and isToken()) {
            $products = $this->cartModel->showCart($_SESSION['token']);
            $this->view('/cart/cart', [
                'title' => 'Cart',
                'token' => $_SESSION['token'],
                'name' => $_SESSION['cartName'],
                'products' => $products
            ]);
        } else {
            header('location:' . URLROOT . 'home/index/');
        }
    }


    /**
     * showTypes - show all category 
     * redirect to types
     * if error redirect to home page
     * @return void
     */
    public function showTypes()
    {
           //////////////////////////////////////////////////////////////////////////////////////////////and isToken()
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $types = $this->cartModel->showTypes();
            $this->view('/cart/types', [
                'title' => 'Category',
                'token' => $_SESSION['token'],
                'name' => $_SESSION['cartName'],
                'types' => $types
            ]);
        } else {
            header('location:' . URLROOT . 'home/index/');
        }
    }

    /**
     * showSingleType - showing product of category was pick 
     * redirect to cart
     * if error redirect to home page
     * @return void
     */
    public function showSingleType()
    {
        //////////////////////////////////////////////////////////////////////////////////////////////and isToken()
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $products = $this->cartModel->productListType($_POST['type']);
            $this->view('/cart/products', [
                'title' => 'Category of products',
                'token' => $_SESSION['token'],
                'name' => $_SESSION['cartName'],
                'products' => $products
            ]);
        } else {
            header('location:' . URLROOT . 'home/index/');
        }
    }

    /**
     * addProduct - add new product to cart 
     * redirect to cart
     * if error redirect to home page
     * @return void
     */
    public function addProduct()
    {
        //////////////////////////////////////////////////////////////////////////////////////////////and isToken()
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            if (!$this->cartModel->isProductInCart($_SESSION['token'], $_POST['product'])) {
                $_SESSION['refreshProduct'] = $_POST['product'];

                $this->cartModel->addNewProductToCart($_SESSION['token'], $_POST['product']);
            }



            $this->show();
        } else {
            header('location:' . URLROOT . 'home/index/');
        }
    }

    /**
     * deleteCart - deleting cart 
     * redirect to home page
     * @return void
     */
    public function deleteCart()
    {
        $this->cartModel->cartDelete($_POST['token']);
        header('location:' . URLROOT . 'home/index/');
    }

    /**
     * deleteProduct deleting product from cart
     * redirect to cart
     * @return void
     */
    public function deleteProduct()
    {
        $this->cartModel->productDelete($_SESSION['token'], $_POST['nameProduct']);
        if ($_SESSION['refreshProduct'] = $_POST['nameProduct']) {
            $_SESSION['refreshProduct'] = '';
        }
        $this->show();
    }
}
