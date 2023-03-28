<div class="modal fade" id="quotesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Selecionar aplicación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="appstable" class="table table-hover table-checkable order-column full-width">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Application</th>
                                <th>Paciente</th>
                                <th>Tratamiento</th>
                                <th>Cordinador</th>
                                <th>Suguerido por</th>
                                <th>Asignado a</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-quote-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Show Quote</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col text-center" id="paciente-modal-name"></div>
                    <div class="table-responsive">
                          <table class="table">
                             <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Dr Fee</th>
                                    <th scope="col">Is Free</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <td>Totales</td>
                                <td><input class="form-control form-control-sm total-price border-0" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                <td><input class="form-control form-control-sm total-drFee border-0" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                <td></td>
                            </tr>
                            
                            </tfoot>
                            <tbody id="edit-cot-table-body">
                                
                            </tbody>
                          </table>
                          <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-info" id="add-field-btn">Add new field</button>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create-quote-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Add Quote</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col text-center" id="paciente-modal-name"></div>
                    <div class="table-responsive">
                          <table class="table">
                             <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Dr Fee</th>
                                    <th scope="col">Is Free</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <td>Totales</td>
                                <td><input class="form-control form-control-sm total-price border-0" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                <td><input class="form-control form-control-sm total-drFee border-0" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '')" type="text" placeholder=""></td>
                                <td></td>
                            </tr>
                            
                            </tfoot>
                            <tbody id="add-cot-table-body">
                                
                            </tbody>
                          </table>
                          <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-info" id="add-field-btn">Add new field</button>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success save-quote-modal" >Save quote</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>