<div class="container">    
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">  Acesso ao sistema</div>
            </div>
            <div style="padding-top:30px" class="panel-body" >
                
                <?= $this->Flash->render() ?>
                
                <?= $this->Form->create() ?>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <?php echo $this->Form->input('email', array('label' => '', 'class' => 'form-control', 'placeholder' => 'E-Mail')); ?>                                       
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <?php echo $this->Form->input('password', array('label' => '', 'class' => 'form-control', 'placeholder' => 'Senha')); ?>                                       
                    </div>

                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <?= $this->Form->button(__(' Entrar'), array('class' => 'btn btn-success glyphicon glyphicon-log-in')) ?>
                        </div>
                    </div>   
                <?= $this->Form->end() ?>    
            </div>                     
        </div>  
    </div>
</div>



