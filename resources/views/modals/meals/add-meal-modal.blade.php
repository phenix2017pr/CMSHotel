<div class="modal fade" id="addMealModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div style="padding: 1em">
                    <form id="" action="/dashboard/meals" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @include('admin.meals.edit-create-form')
                        <div class="form-group">
                            <button type="submit" class="btn btn-info" style="width: 100%;">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>