<?php
App::uses('AppController', 'Controller');
/**
 * Employees Controller
 *
 * @property Employee $Employee
 * @property PaginatorComponent $Paginator
 */
class EmployeesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public $uses = array('Employee', 'Department');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Employee->recursive = 0;
		$this->set('employees', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Employee->exists($id)) {
			throw new NotFoundException(__('Invalid employee'));
		}
		$options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));
		$this->set('employee', $this->Employee->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			try {
				$this->Employee->create();
				$lastNo = $this->Employee->find('first', array(
							'fields' => array('Employee.employee_no'),
							'order' => array('Employee.employee_no' => 'DESC'),
							'recursive' => -1,
						));
				if (!$lastNo)
					$lastNo = array('Employee' => array('employee_no' => 0));
				$this->Employee->set('employee_no', $lastNo['Employee']['employee_no'] + 10);
				$this->Employee->set('creator', 9999);
				$this->Employee->set('updated', false);
				if (!$this->Employee->save($this->request->data)) {
					throw new Exception(
							sprintf(
									__('The employee could not be saved. Please, try again. Error: %s'),
									(!empty($this->Employee->validationErrors)) ? var_export($this->Employee->validationErrors, true) : $this->Employee->lastError()
									)
							);
				}
				$this->Flash->success(__('The employee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} catch (Exception $e) {
				$this->Flash->error($e->getMessage());
			}
		}
		$this->set('managers', $this->Employee->find('list', array(
				'fields' => array('employee_no', 'employyee_name'),
				'order' => array('Employee.employee_no' => 'ASC'),
				'recursive' => -1,
		)));
		$this->set('departments', $this->Department->find('list', array(
				'fields' => array('department_no', 'department_name'),
				'order' => array('Department.department_no' => 'ASC'),
				'recursive' => -1,
		)));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Employee->exists($id)) {
			throw new NotFoundException(__('Invalid employee'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Employee->save($this->request->data)) {
				$this->Flash->success(__('The employee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The employee could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));
			$this->request->data = $this->Employee->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Employee->id = $id;
		if (!$this->Employee->exists()) {
			throw new NotFoundException(__('Invalid employee'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Employee->delete()) {
			$this->Flash->success(__('The employee has been deleted.'));
		} else {
			$this->Flash->error(__('The employee could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
