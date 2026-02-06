<?php
namespace App\Controller;
use CloudCastle\Http\Router\Loader\AttributeLoader;
use CloudCastle\Http\Router\Loader\Route;
use CloudCastle\Http\Router\Router;
use App\Model\TasksModel;

class TasksController extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = new TasksModel();
    }

    public function index()
    {
        $data = $this->db->findAll();

        if (!$data) {
            throw new \Exception('Данных с таким id не существует');
        }

        $this->render('tasks', ['data' => $data]);
    }

    public function show(int $id)
    {
        $data = $this->db->find($id);

        if (!$data) {
            throw new \Exception('Данных с таким id не существует');
        }

        $this->render('task', ['data' => $data]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim(strip_tags($_POST['title'])),
                'description' => trim(strip_tags($_POST['description'])),
                'status' => 'n', //изначально ставим не активным
            ];
            // можем получить id, если ajax запрос к примеру: $id = $this->db->create($data);
            $this->db->create($data);
            $this->redirect('/tasks/');
        }
    }

    public function edit($id)
    {
        $task = $this->db->find($id);

        if (!$task) {
            throw new \Exception('Такой записи нет');
        }

        $status = isset($_POST['status']) && $_POST['status'] === 'y' ? 'y' : 'n';

        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'status' => $status,
        ];

        $this->db->update($id, $data);
        $this->redirect('/tasks/' . $id);
    }

    public function delete($id)
    {
        $this->db->delete($id);
        $this->redirect('/tasks/');
    }
}