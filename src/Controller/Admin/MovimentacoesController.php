<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Movimentacoes Controller
 *
 * @property \App\Model\Table\MovimentacoesTable $Movimentacoes
 */
class MovimentacoesController extends AppController
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
                                
                if($optionSearch == 'Movimentacoes.created'){
                    $search = implode("-",array_reverse(explode("/",$search)));
                }
                $movimentacoes = $this->Movimentacoes->find('all')->contain(['Tipos', 'Users'])
                        ->innerJoin('users', 'users.id = Movimentacoes.users_id')
                        ->innerJoin('tipos', 'tipos.id = Movimentacoes.tipos_id')
                        ->where(['CAST('.$optionSearch.' AS CHAR ) LIKE ' => '%'.$search.'%']);
        }  else {
            $movimentacoes = $this->Movimentacoes->find('all')->contain(['Tipos', 'Users'])
                ->innerJoin('users', 'users.id = Movimentacoes.users_id')
                ->innerJoin('tipos', 'tipos.id = Movimentacoes.tipos_id');
        }
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'movimentacoes.pdf'
        ];
        $this->set('movimentacoes', $this->paginate($movimentacoes));
        $this->set('_serialize', ['movimentacoes']);
    }
    
    public function report_lancamentos_diarios() {
        
        $dataAtual = implode("-",array_reverse(explode("/",date('d/m/Y'))));

        $movimentacoes = $this->Movimentacoes->find('all')->contain(['Tipos', 'Users'])
                ->innerJoin('users', 'users.id = Movimentacoes.users_id')
                ->innerJoin('tipos', 'tipos.id = Movimentacoes.tipos_id')
                ->where(['CAST(Movimentacoes.created AS CHAR ) LIKE ' => '%' . $dataAtual . '%']);

        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'report_lancamentos_diarios.pdf'
        ];
        $this->set('movimentacoes', $this->paginate($movimentacoes));
        $this->set('_serialize', ['movimentacoes']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Movimentaco id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $movimentaco = $this->Movimentacoes->get($id, [
            'contain' => ['Tipos', 'Users']
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Movimentacao_' . $id . '.pdf'
        ];
        $this->set('movimentaco', $movimentaco);
        $this->set('_serialize', ['movimentaco']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $movimentaco = $this->Movimentacoes->newEntity();
        if ($this->request->is('post')) {
            $movimentaco = $this->Movimentacoes->patchEntity($movimentaco, $this->request->data);
            if ($this->Movimentacoes->save($movimentaco)) {
                $this->Flash->success(__('Movimentação salva com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('A movimentação não foi salva. Por favor, Tente novamente.'));
            }
        }
        $tipos = $this->Movimentacoes->Tipos->find('list', ['limit' => 200]);
        $users = $this->Movimentacoes->Users->find('list', ['limit' => 200]);
        $this->set(compact('movimentaco', 'tipos', 'users'));
        $this->set('_serialize', ['movimentaco']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Movimentaco id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $movimentaco = $this->Movimentacoes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $movimentaco = $this->Movimentacoes->patchEntity($movimentaco, $this->request->data);
            if ($this->Movimentacoes->save($movimentaco)) {
                $this->Flash->success(__('Movimentação salva com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('A movimentação não foi salva. Por favor, Tente novamente.'));
            }
        }
        $tipos = $this->Movimentacoes->Tipos->find('list', ['limit' => 200]);
        $users = $this->Movimentacoes->Users->find('list', ['limit' => 200]);
        $this->set(compact('movimentaco', 'tipos', 'users'));
        $this->set('_serialize', ['movimentaco']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Movimentaco id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $movimentaco = $this->Movimentacoes->get($id);
        if ($this->Movimentacoes->delete($movimentaco)) {
            $this->Flash->success(__('Movimentação deletada com sucesso.'));
        } else {
            $this->Flash->error(__('A movimentação não foi deletada. Por favor, Tente novamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
