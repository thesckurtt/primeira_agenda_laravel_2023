<?php
use App\PrimeiraAgenda\Funcoes;
$estados_br = Funcoes::getEstados();
if (session()->has('telefone_error')) {
    $telefone_error = session()->get('telefone_error');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<x-HeadCadastrosHTML /> {{-- componente do <head></head> --}}

<body class="bg-site">
    <x-HeaderDashboardSite />

    <section class="section-cadastro">
        <div class="div-cadastro container limit limit-cadastro">
            <a href="{{ route('dashboard.index') }}" type="submit" class="btn btn-warning mb-5 px-4"><i
                    class="fa-solid fa-backward"></i> Voltar</a>
            <p class="h2">Cadastro de usuário</p>
            <hr class="hr-line-header">
            @if ($errors->any())
                <div class="alert-error  .alert-warning ">
                    <span><strong>ATENÇÃO!</strong> <br>Alguns campos foram preenchidos de forma errada! </span><i
                        class="fa-solid fa-xmark" data-btn-id="close-alert-error"></i>
                </div>
            @endif
            <form action="{{ route('dashboard.cadastrar') }}" method="POST">
                @csrf
                <p class="h4">Informações pessoais</p>
                <div class="row">
                    <div class="col-sm">
                        <label>Nome</label>
                        <input name="nome" id="nome" type="text" <?php if ($errors->hasAny('nome')) {
                            echo 'style="color: #872e2e; border: 2px solid #bf6d6d !important; background-color: #e28080;"';
                        } ?> class="form-control"
                            placeholder="Nome" value="{{ old('nome') }}" required>
                        @if ($errors->hasAny('nome'))
                            @foreach ($errors->get('nome') as $error)
                                <span style="color: #5b4f84">*{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <label>Telefone</label>
                        <input name="telefone" id="telefone" type="text" <?php if ($errors->hasAny('telefone') || session()->has('telefone_error')) {
                            echo 'style="color: #872e2e; border: 2px solid #bf6d6d !important; background-color: #e28080;"';
                        } ?> class="form-control"
                            placeholder="Telefone" value="{{ old('telefone') }}" required>
                        @if ($errors->hasAny('telefone'))
                            @foreach ($errors->get('telefone') as $error)
                                <span style="color: #5b4f84">*{{ $error }}</span>
                            @endforeach
                        @elseif(session()->has('telefone_error'))
                            <span style="color: #5b4f84">*{{ $telefone_error }}</span>
                            @php
                                session()->pull('telefone_error');
                            @endphp
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-7">
                        <label>Email</label>
                        <input name="email" id="email" type="text" <?php if ($errors->hasAny('email')) {
                            echo 'style="color: #872e2e; border: 2px solid #bf6d6d !important; background-color: #e28080;"';
                        } ?> class="form-control"
                            placeholder="Email" value="{{ old('email') }}">
                        @if ($errors->hasAny('email'))
                            @foreach ($errors->get('email') as $error)
                                <span style="color: #5b4f84">*{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                <hr class="hr-line-group">
                <p class="h4">Endereço</p>
                <div class="row">
                    <div class="col-sm-3">
                        <label>CEP</label>
                        <input name="endereco_cep" id="cep" maxlength="8" id="cep" type="text"
                            <?php if ($errors->hasAny('endereco_cep')) {
                                echo 'style="color: #872e2e; border: 2px solid #bf6d6d !important; background-color: #e28080;"';
                            } ?> class="form-control" placeholder="0000000"
                            value="{{ old('endereco_cep') }}">
                        @if ($errors->hasAny('endereco_cep'))
                            @foreach ($errors->get('endereco_cep') as $error)
                                <span style="color: #5b4f84">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-sm-9">
                        <label>Rua</label>
                        <input name="endereco_rua" id="rua" type="text" class="form-control"
                            placeholder="Rua Dr. Lorem Ipsum" value="{{ old('endereco_rua') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Número</label>
                        <input name="endereco_numero" type="text" class="form-control" placeholder="123"
                            value="{{ old('endereco_numero') }}">
                    </div>
                    <div class="col-sm-4">
                        <label>Complemento</label>
                        <input name="endereco_complemento" id="complemento" type="text" class="form-control"
                            placeholder="" value="{{ old('endereco_complemento') }}">
                    </div>
                    <div class="col-sm-4">
                        <label>Bairro</label>
                        <input name="endereco_bairro" id="bairro" type="text" class="form-control"
                            placeholder="Bairro Lorem" value="{{ old('endereco_bairro') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Cidade</label>
                        <input name="endereco_cidade" id="cidade" type="text" class="form-control"
                            placeholder="Lorem" value="{{ old('endereco_cidade') }}">
                    </div>
                    <div class="col-sm-5">
                        <label>Estado</label>
                        <select name="endereco_estado" id="endereco_estado" class="form-control" placeholder="UF"
                            style="cursor: pointer;" value="{{ old('endereco_estado') }}">
                            <option value="" default>UF</option>
                            @foreach ($estados_br as $key => $estado)
                                <option value="{{ $key }}" default>{{ $estado }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr class="hr-line-group">
                <p class="h4">Observações</p>
                <div class="row">
                    <div class="col-sm">
                        <label>Nota</label>
                        <textarea name="notas" class="form-control" id="exampleFormControlTextarea1" rows="3"
                            placeholder="Lorem ipsum dolor sit amet...">{{ old('notas') }}</textarea>
                    </div>
                </div>
                <div class="row div-btn-cadastro">
                    <div class="col-sm control-btn-cadastro">
                        <button type="submit" class="btn btn-success">Salvar&nbsp;&nbsp;<i
                                class="fa-solid fa-check"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <x-CadastrosScripts/>
</body>
</html>
