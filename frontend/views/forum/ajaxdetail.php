<div class="modal-dialog">
    <div class="modal-content">
        <?php if(isset($detail)&&is_array($detail)&&count($detail)>0){ ?>
            <div class="modal-header">
                <div class="close">
                    <i role="button" class="icon"></i>
                </div>
                <h3 class="modal-title"><?=$detail['title']?></h3>
            </div>
            <div class="modal-body">
                <div class="forum-detaill">
                    <?=$detail['content']?>
                </div>
            </div>
        <?php   } ?>
    </div>
</div>
