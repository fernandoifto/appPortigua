<?php
namespace App\Controller\Admin;

use App\Controller\AppController;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */

    public function index() {
        $search = null;
        if(isset($this->request->query['search'])){
                $search = $this->request->query['search'];
                $optionSearch = $this->request->query['optionSearch'];
                
            $this->paginate = [
                'conditions' => ['and' => [
                     $optionSearch .' LIKE ' => '%' . $search . '%'
                ]]
            ];
        }
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'users.pdf'
        ];
        
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    
    public function view($id = null){
        $user = $this->Users->get($id, [
            'contain' => ['Movimentacoes']
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'User_' . $id . '.pdf'
        ];
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('O usuário salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O usuário não foi salvo. Por favor, Tente novamente.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('O usuário salvo com sucesso.'));
                if ($user['role'] != 'Administrador'){
                     return $this->redirect(['controller' => 'Movimentacoes','action' => 'index']);
                }  else {
                    return $this->redirect(['action' => 'index']);
                }
                
            } else {
                $this->Flash->error(__('O usuário não foi salvo. Por favor, Tente novamente.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('O usuário deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O usuário não foi deletado. Por favor, Tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function login(){
        if($this->request->is('post')){
            $user = $this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
                 $this->Flash->success(__('Bem vindo a Administração do Sistema.'));
                return $this->redirect($this->Auth->redirectUrl());
            }  else {
                unset($this->request->data['password']);
                $this->Flash->error('O úsuario ou senha invalidos, tente novamente.');
            }
        }
    }

    public function logout(){
        $this->Flash->warning(__('Você saiu do sistema administrativo, Volte sempre.'));
        return $this->redirect($this->Auth->logout());
    }
    
    public function isAuthorized($user){
        if ($user['role'] == 'Administrador') {
            return true;
        }  else {
            return false;
        }
    }
    
}
