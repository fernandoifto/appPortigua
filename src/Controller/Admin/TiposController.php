<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Tipos Controller
 *
 * @property \App\Model\Table\TiposTable $Tipos
 */
class TiposController extends AppController
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
        
        $this->set('tipos', $this->paginate($this->Tipos));
        $this->set('_serialize', ['tipos']);
    }

    public function search(){
        if($this->request->is('post')){
            $search = null;
            if(isset($this->request->data['search'])){
                $search = $this->request->data['search'];
                $optionSearch = $this->request->data['optionSearch'];
            }
            $tipos = $this->Tipos->find('all',
                    [
                        'conditions' => [
                            'Tipos.'.$optionSearch.' LIKE '=> '%'.$search.'%'
                        ]
                    ]
            );
            
            $this->set('tipos', $this->paginate($tipos));
            $this->render('index');
        }  else {
            throw new NotFoundException("Pagina não encontrada");
        }
    }

    /**
     * View method
     *
     * @param string|null $id Tipo id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    
    public function view($id = null)
    {
        $tipo = $this->Tipos->get($id, [
            'contain' => ['Movimentacoes']
        ]);
        $this->set('tipo', $tipo);
        $this->set('_serialize', ['tipo']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tipo = $this->Tipos->newEntity();
        if ($this->request->is('post')) {
            $tipo = $this->Tipos->patchEntity($tipo, $this->request->data);
            if ($this->Tipos->save($tipo)) {
                $this->Flash->success(__('Tipo salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Tipo não foi salvo. Por favor, Tente novamente.'));
            }
        }
        $this->set(compact('tipo'));
        $this->set('_serialize', ['tipo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tipo id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tipo = $this->Tipos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipo = $this->Tipos->patchEntity($tipo, $this->request->data);
            if ($this->Tipos->save($tipo)) {
                $this->Flash->success(__('Tipo salvo com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Tipo não foi salvo. Por favor, Tente novamente.'));
            }
        }
        $this->set(compact('tipo'));
        $this->set('_serialize', ['tipo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tipo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tipo = $this->Tipos->get($id);
        if ($this->Tipos->delete($tipo)) {
            $this->Flash->success(__('Tipo deletado com sucesso.'));
        } else {
            $this->Flash->error(__('Tipo não foi deletado. Por favor, Tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}