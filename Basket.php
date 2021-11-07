<?php 

    class Basket {

        private $sessName;
        
        public function __construct($sessName)
        {
            session_start();
            $this -> sessName = $sessName;
            if (!isset($_SESSION[$this -> sessName])) $_SESSION[$this -> sessName] = [];
        }
        public function itemExist($itemId) 
        {
            if (isset($_SESSION[$this -> sessName][$itemId])) return true;    
        }
        public function updateItem($itemId, $columName, $newData) 
        {
            if ($this -> itemExist($itemId)) {
                $_SESSION[$this -> sessName][$itemId][$columName] = $newData;
            }
        }
        public function getItem($itemId) 
        {
            if ($this -> itemExist($itemId)) return $_SESSION[$this -> sessName][$itemId];
        }
        public function addItem($itemId, $data = [])
        {
            if (!$this -> itemExist($itemId)) {
                $_SESSION[$this -> sessName][$itemId] = $data;
                $_SESSION[$this -> sessName][$itemId]['count'] = 1;
                $_SESSION[$this -> sessName][$itemId]['total_price'] = $this -> getItem($itemId)['price'];
            }else {
                $this -> updateItem($itemId, 'count', $_SESSION[$this -> sessName][$itemId]['count'] += 1);
                $thisItem = $this -> getItem($itemId);
                $total_count = $thisItem['count'] * $thisItem['price'];
                $this -> updateItem($itemId, 'total_price', $total_count);
            }
        }
        public function removeItem($itemId)
        {
            if ($this -> itemExist($itemId)) {
                unset($_SESSION[$this -> sessName][$itemId]);
            }
        }
        public function decraseItem($itemId)
        {
            if ($this -> itemExist($itemId)) {
                if ($this -> getItem($itemId)['count'] === 1) $this -> removeItem($itemId);
                else {
                    $this -> updateItem($itemId, 'count', $_SESSION[$this -> sessName][$itemId]['count'] -= 1);
                    $thisItem = $this -> getItem($itemId);
                    $total_count = $thisItem['count'] * $thisItem['price'];
                    $this -> updateItem($itemId, 'total_price', $total_count);
                }
            }
        }
        public function cardTotalPrice() 
        {
            $total_price = 0;
            if (is_array($_SESSION[$this -> sessName]) && $_SESSION[$this -> sessName] !== []) {
                foreach($_SESSION[$this -> sessName] as $card) {
                    $total_price += $card['total_price'];
                }
            }
            return $total_price;
        }
        public function cardTotalCount() 
        {
            $total_price = 0;
            if (is_array($_SESSION[$this -> sessName]) && $_SESSION[$this -> sessName] !== []) {
                foreach($_SESSION[$this -> sessName] as $card) {
                    $total_price += $card['count'];
                }
            }
            return $total_price;
        }
    }

?>