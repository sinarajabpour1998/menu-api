<?php

class MenuController {
    use Controller;
    private $menuModel;

    public function __construct($menuModel) {
        $this->menuModel = $menuModel;
    }

    public function create() {
        $name = $this->safe($_POST['name']) ?? null;
        $parent_id = $this->safe($_POST['parent_id']) ?? null;

        if (!$name) {
            $this->response(['error' => 'please enter the menu name']);
        }

        $success = $this->menuModel->createMenu($name, $parent_id);

        if ($success) {
            $this->response(['message' => 'Menu has been created successfully']);
        } else {
            $this->response(['error' => 'Something went wrong']);
        }
    }

    public function get() {
        $menus = $this->menuModel->getAllMenus();

        $menuTree = [];
        $menuMap = [];

        foreach ($menus as $menu) {
            $menuMap[$menu['id']] = [
                'id' => $menu['id'],
                'name' => $menu['name'],
                'Childes' => []
            ];
        }

        foreach ($menus as $menu) {
            if ($menu['parent_id'] == null) {
                $menuTree[] = &$menuMap[$menu['id']];
            } else {
                $menuMap[$menu['parent_id']]['Childes'][] = &$menuMap[$menu['id']];
            }
        }

        $this->response($menuTree);
    }
}
