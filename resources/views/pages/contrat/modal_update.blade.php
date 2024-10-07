
{{-- Modal camions--}}
<div
    class="modal fade"
    id="camions"
    tabindex="-1"
    aria-labelledby="camions"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-light text-white">
                <div class="row">
                    <div class="col-4 top">
                        <button
                            type="button"
                            id="btn-ajouter"
                            class="
                                          justify-content-center
                                          w-100
                                          btn btn-rounded btn-outline-success
                                          d-flex
                                          align-items-center
                                        "
                        >
                            <i
                                data-feather="plus-circle"
                                class="feather-sm fill-white me-2"
                            ></i>
                            Ajouter
                        </button>
                    </div>
                    <div class="col-4 top">
                        <button
                            type="button"
                            id="btn-update-camion"
                            class="
                                      justify-content-center
                                      w-100
                                      btn btn-rounded btn-outline-info
                                      d-flex
                                      align-items-center
                                    "
                        >
                            <i
                                data-feather="edit"
                                class="feather-sm fill-white me-2"
                            ></i>
                            Modifier
                        </button>
                    </div>
                    <div class="col-4 top">
                        <button
                            id="btn-delete-camion"
                            type="button"
                            class="
                                      justify-content-center
                                      w-100
                                      btn btn-rounded btn-outline-danger
                                      d-flex
                                      align-items-center
                                    "
                        >
                            <i
                                data-feather="trash-2"
                                class="feather-sm fill-white me-2"
                            ></i>
                            Supprimer
                        </button>
                    </div>
                    <div class="col-6"></div>
                </div>
                <button
                    type="button"
                    class="btn-close bg-dark"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table
                        id="table_vehicule_contrat"
                        class="table table-striped table-bordered display"
                        style="width: 100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Immatriculation</th>
                            <th>Type</th>
                            <th>Marque</th>
                        </tr>
                        </thead>
                        <tbody id="table_body_cars">

                        </tbody>
                        <tfoot>
                        <th>#</th>
                        <th>Immatriculation</th>
                        <th>Type</th>
                        <th>Marque</th>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer row">
                <div class="offset-8 col-4">
                    <button
                        id="btn-select-camion"
                        type="button"
                        class="
                                      justify-content-center
                                      w-100
                                      btn btn-rounded btn-outline-info
                                      d-flex
                                      align-items-center
                                    "
                    >
                        <i
                            data-feather="save"
                            class="feather-sm fill-white me-2"
                        ></i>
                        Sélectionner
                    </button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- End  Modal camions--}}
{{--add form car modal--}}
<div
    class="modal fade"
    id="formAddCar"
    tabindex="-1"
    aria-labelledby="formAddCar"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                <h4 class="modal-title">
                    Ajouter un camion
                </h4>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="formStoreCar" >
                    <input type="hidden" value="{{ csrf_token() }}" id="_token">
                    <div class="row" >
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="registration"
                                    id="registration"
                                    required
                                    class="form-control"
                                    placeholder="11GH0000"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Immatriculation <span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <select
                                    name="type_car"
                                    id="type_car"
                                    class="form-control"
                                    required
                                    style="width: 100%; height: 36px"
                                >
                                    <option disabled selected>Choisir un type de camion</option>
                                    @foreach($typeCars as $type)
                                        <option value="{{$type->id}}">{{$type->libelle}}</option>
                                    @endforeach
                                </select>
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Type de camion <span class="text-danger">*</span> </label
                                >
                            </div>

                            <div class="form-floating mb-3">
                                <select
                                    name="brand_car"
                                    id="brand_car"
                                    class="form-control"
                                    required
                                    style="width: 100%; height: 36px"
                                >
                                    <option disabled selected>Choisir une marque de camion</option>
                                    @foreach($brandCars as $brand)
                                        <option value="{{$brand->id}}">{{$brand->libelle}}</option>
                                    @endforeach
                                </select>
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Marque du camion <span class="text-danger">*</span> </label
                                >
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="model"
                                    id="model"
                                    class="form-control"
                                    placeholder="Modèle"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Modèle</label
                                >
                            </div>

                            <div class="form-floating mb-3">
                                <input
                                    type="number"
                                    step="0.01"
                                    name="payload"
                                    id="payload"
                                    class="form-control"
                                    placeholder="Charge utile"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Charge utile (T)</label
                                >
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex align-items-center">
                        <div class="mt-3 mt-md-0 ms-auto">
                            <button
                                type="submit"
                                class="
                                                btn btn-info
                                                font-weight-medium
                                                rounded-pill
                                                px-4
                                              "
                                id="btn-form-car"
                            >
                                <div class="d-flex align-items-center">
                                    <i
                                        data-feather="send"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Enregistrer
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- end car Modal--}}

{{--update form car modal--}}
<div
    class="modal fade"
    id="formUpCar"
    tabindex="-1"
    aria-labelledby="formUpCar"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                <h4 class="modal-title">
                    Modifier le camion
                </h4>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="formUpdateCar" >
                    <input type="hidden" value="{{ csrf_token() }}" id="_tokenUp">
                    <div id="formCar" >



                    </div>
                    <div class="d-md-flex align-items-center">
                        <div class="mt-3 mt-md-0 ms-auto">
                            <button
                                type="submit"
                                class="
                                    btn btn-info
                                    font-weight-medium
                                    rounded-pill
                                    px-4
                                  "
                                id="btn-form-car"
                            >
                                <div class="d-flex align-items-center">
                                    <i
                                        data-feather="send"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Enregistrer
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- end car Modal--}}


{{-- Modal conducteurs--}}
<div
    class="modal fade"
    id="conducteurs"
    tabindex="-1"
    aria-labelledby="conducteurs"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-light text-white">
                <div class="row">
                    <div class="col-4 top">
                        <button
                            type="button"
                            id="btn-add-driver"
                            class="
                                      justify-content-center
                                      w-100
                                      btn btn-rounded btn-outline-success
                                      d-flex
                                      align-items-center
                                    "
                        >
                            <i
                                data-feather="plus-circle"
                                class="feather-sm fill-white me-2"
                            ></i>
                            Ajouter
                        </button>
                    </div>
                    <div class="col-4 top">
                        <button
                            type="button"
                            id="btn-update-driver"
                            class="
                                      justify-content-center
                                      w-100
                                      btn btn-rounded btn-outline-info
                                      d-flex
                                      align-items-center
                                    "
                        >
                            <i
                                data-feather="edit"
                                class="feather-sm fill-white me-2"
                            ></i>
                            Modifier
                        </button>
                    </div>
                    <div class="col-4 top">
                        <button
                            id="btn-delete-driver"
                            type="button"
                            class="
                                      justify-content-center
                                      w-100
                                      btn btn-rounded btn-outline-danger
                                      d-flex
                                      align-items-center
                                    "
                        >
                            <i
                                data-feather="trash-2"
                                class="feather-sm fill-white me-2"
                            ></i>
                            Supprimer
                        </button>
                    </div>
                    <div class="col-6"></div>
                </div>
                <button
                    type="button"
                    class="btn-close bg-dark"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table
                        id="table_driver_contrat"
                        class="table table-striped table-bordered display"
                        style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>N° Permis</th>
                                <th>Nom</th>
                                <th>Prénoms</th>
                            </tr>
                        </thead>
                        <tbody id="table_body_driver_contrat">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>N° Permis</th>
                                <th>Nom</th>
                                <th>Prénoms</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="offset-8 col-4">
                    <button
                        id="btn-select-driver"
                        type="button"
                        class="
                          justify-content-center
                          w-100
                          btn btn-rounded btn-outline-info
                          d-flex
                          align-items-center
                        "
                    >
                        <i
                            data-feather="save"
                            class="feather-sm fill-white me-2"
                        ></i>
                        Sélectionner
                    </button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- End  Modal conducteurs--}}

{{--add form driver modal--}}
<div
    class="modal fade"
    id="formAddDriver"
    tabindex="-1"
    aria-labelledby="formAddDriver"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                <h4 class="modal-title">
                    Ajouter un conducteur
                </h4>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="formStoreDriver" >
                    <input type="hidden" value="{{ csrf_token() }}" id="_token_driver">
                    <div class="row" >
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="first"
                                    id="first"
                                    required
                                    class="form-control"
                                    placeholder="Entrez le nom"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Nom <span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="last"
                                    id="last"
                                    required
                                    class="form-control"
                                    placeholder="Entrez le prénom"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Prénom <span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="permis"
                                    id="permis"
                                    required
                                    class="form-control"
                                    placeholder="Entrez le numéro du permis de conduire"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Numéro du permis de conduire <span class="text-danger">*</span></label
                                >
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="date"
                                    name="date_permis"
                                    id="date_permis"
                                    class="form-control"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Date d'établissement</label
                                >
                            </div>

                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="lieu_permis"
                                    id="lieu_permis"
                                    class="form-control"
                                    placeholder="Entrez le lieu d'établissement"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Lieu d'établissement</label
                                >
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex align-items-center">
                        <div class="mt-3 mt-md-0 ms-auto">
                            <button
                                type="submit"
                                class="
                                    btn btn-info
                                    font-weight-medium
                                    rounded-pill
                                    px-4
                                  "
                                id="btn-form-driver"
                            >
                                <div class="d-flex align-items-center">
                                    <i
                                        data-feather="send"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Enregistrer
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- end driver Modal--}}

{{--update form driver modal--}}
<div
    class="modal fade"
    id="formUpDriver"
    tabindex="-1"
    aria-labelledby="formUpDriver"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                <h4 class="modal-title">
                    Modifier le conducteur
                </h4>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="formUpdateDriver" >
                    <input type="hidden" value="{{ csrf_token() }}" id="_token_driverUp">
                    <div class="row" id="formDriver" >

                    </div>
                    <div class="d-md-flex align-items-center">
                        <div class="mt-3 mt-md-0 ms-auto">
                            <button
                                type="submit"
                                class="
                                    btn btn-info
                                    font-weight-medium
                                    rounded-pill
                                    px-4
                                  "
                            >
                                <div class="d-flex align-items-center">
                                    <i
                                        data-feather="send"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Enregistrer
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
{{-- end driver Modal--}}
