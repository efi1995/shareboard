<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
    <div class="row"style="margin-top:2%">
        <div class="col-md-12">
            <a class="navbar-right fs-100" style="margin-right:2%" href="<?php echo ROOT_PATH; ?>wiki/add" title="Add new wiki" ><span class="glyphicon glyphicon-plus"></span></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
        <h2 class="text-center">Wiki Page</h2>
            <br/><br/><br/><br/><br/>
            <div>
                <?php foreach($viewmodel[1] as $item) :?>
                    <input type="hidden" name="Task_edit_id" value="<?php echo $item['wiki_id'];?>"/>
                    <a name="task_edit" href="<?php echo ROOT_PATH;?>wiki/<?php echo $item['wiki_id'];?>">
                    <h4 class="task-title" style="margin-left:21%;"><?php echo $item['wiki_title'];?></h4></a><br/>
                    <hr style="margin-left:19%;">
                <?php endforeach;?>			
            </div>
        </div>
        <?php 
        $id = $_GET["id"];
        if($id != ""){
            $wiki       = $viewmodel[2];
            $wiki_title = $wiki[0]['wiki_title'];
            $wiki_body  = $wiki[0]['wiki_body'];
            ?>
            <div class="col-md-9" style="border-left:1px black solid">
                <div class="row" style="margin-top:2%">
                    <div class="col-sm-12 text-center">
                        <h2><?php echo $wiki_title;?></h2>
                    </div>
                </div>
                <div class="row" style="margin-top:2%">
                    <div class="col-md-1"></div>
                    <div class="col-sm-11">
                        <?php echo $wiki_body;?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
                <div class="col-md-9" style="border-left:1px #aeaeae solid">
                    <div class="row h-100 align-items-center justify-content-center text-center">
                        <div class="col-lg-10 align-self-end">
                            <h1 class="text-uppercase font-weight-bold">Your Favorite Source of Shareboard</h1>
                            <hr class="divider my-4">
                        </div>
                        <div class="col-lg-8 align-self-baseline">
                            <p class="text-white-75 font-weight-light mb-5">Start Wiki page can help you build better websites using the Shareboard! Just create new wiki and start customizing!</p>
                            <a class="btn btn-primary btn-xl js-scroll-trigger" href="<?php echo ROOT_URL; ?>wiki/add">Start Now</a>
                        </div>
                    </div>                    
                </div> 
        <?php } ?>
    </div>
</form>