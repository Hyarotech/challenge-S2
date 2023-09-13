
<div class="flex items-start space-x-4 mb-4">
        <div class="avatar">
            <div class="w-12 rounded-full">
                <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                </div>
            </div>
        <div class="flex-grow">
            <form action="<?= $action; ?>" method="POST" class="w-full">
                <textarea name="message" class="w-full h-20 p-2 text-white bg-base-300 rounded-lg focus:outline-none mb-2" placeholder="Ajouter un commentaire"></textarea>
                <?php if(isset($pageId)): ?>
                    <input type="hidden" name="page_id" value="<?= $pageId ?>"/>
                <?php endif; ?>
                    <div class = "flex justify-end">
                    <button class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
</div>
