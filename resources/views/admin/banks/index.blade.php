@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 z-depth-2 panel">
                <h5>Listagem de Bancos</h5>

                <a href="{{ route('admin.banks.create') }}" class="btn waves-effect">Criar</a>

                <search :search="search"></search>

                <table class="bordered striped highlight centered responsive-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banks as $bank)
                        <tr>
                            <td>{{ $bank->id }}</td>
                            <td>
                                <img src="{{ asset("storage/banks/images/{$bank->logo}") }}" class="bank-logo" />
                            </td>
                            <td>{{ $bank->name }}</td>
                            <td>
                                <a href="{{ route('admin.banks.edit', ['bank' => $bank->id]) }}" title="Edit">
                                    <i class="material-icons">mode_edit</i>
                                </a>
                                <delete-action action="{{ route('admin.banks.destroy', ['bank' => $bank->id]) }}" action-element="link-delete-{{ $bank->id }}" csrf-token="{{ csrf_token() }}">
                                    <a id="link-modal-{{ $bank->id }}" href="#modal-delete-{{ $bank->id }}" title="Delete">
                                        <i class="material-icons">delete</i>
                                    </a>
                                    <modal :modal="{{ json_encode(['id' => "modal-delete-$bank->id"]) }}" style="display: none;">
                                        <div slot="content">
                                            <h5>Comfirm...</h5>
                                            <div class="divider"></div>
                                            <p>Do you want to delete the {{ $bank->name }} bank?</p>
                                        </div>
                                        <div slot="footer">
                                            <button id="link-delete-{{ $bank->id }}" class="btn btn-flat red waves-effect modal-close">Delete</button>
                                            <button class="btn btn-flat waves-effect modal-close">Cancel</button>
                                        </div>
                                    </modal>
                                </delete-action>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $banks->links() !!}
            </div>
        </div>
    </div>

    <script type="text/javascript">
        export default {
            data() {
                return {
                    modal: {
                        id: 'modal-delete'
                    },
                    bank: null,
                    search: ""
                };
            },
            methods: {
                openModalDelete(id) {
                    this.bank = id;
                    $('#bank').val(id);
                    $('#'+this.modal.id).openModal();
                }
            },
            events: {
                'filter::submited'(search) {
                    this.search = search;
                    alert('aaa');
                }
            }
        };
    </script>
@endsection