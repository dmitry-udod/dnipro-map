<!-- Claim Modal -->
<div class="modal fade brown" id="claim-modal" tabindex="-1" role="dialog" aria-labelledby="claim-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Скарга</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <create-claim categories-json="{{ base64_encode(json_encode(\App\ClaimCategory::all())) }}"></create-claim>
            </div>
        </div>
    </div>
</div>