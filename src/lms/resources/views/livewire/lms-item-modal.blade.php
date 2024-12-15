<!-- Delete Item Modal -->
<div wire:ignore.self class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteItemModalLabel">アイテム削除</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyItem">
                <div class="modal-body">
                    <h4>このアイテムを削除しますか？</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary">削除</button>
                </div>
            </form>
        </div>
    </div>
</div>