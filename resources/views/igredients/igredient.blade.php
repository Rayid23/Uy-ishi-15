@extends('layouts.admin')

@section('title', 'Компания')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Игредиенты</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item "><a style="color:grey" href="{{route('food.main')}}">Блюда</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('igredient.main')}}">Игредиенты</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-dark text-center">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary card-title me-2" data-bs-toggle="modal"
                                data-bs-target="#CreateIgredient">
                                Добавить
                            </button>

                            <!-- Внутренности -->
                            <div class="modal fade" id="CreateIgredient" tabindex="-1" aria-labelledby="CreateFoodLabel"
                                aria-hidden="true">

                                <div class="modal-dialog" style="border: 1px solid green; border-radius:7px">

                                    <div class="modal-content bg-dark">

                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-success" id="CreateFoodLabel">Добавить
                                                игредиенты в блюдо</h1>
                                            <button type="button" class="btn-close btn-dark" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">

                                            <form action="{{route('igredient.store')}}" method="POST">
                                                @csrf

                                                <div>
                                                    <label for="name" class="form-label"></label>
                                                    <input type="text"
                                                        class="form-control text-center border-success bg-dark"
                                                        id="name" name="name" placeholder="Название блюды">
                                                </div>


                                                <div class="modal-footer" style="margin-top:42px">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Назад</button>
                                                    <button type="submit" class="btn btn-success">Сохранить</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{route("igredient.main")}}" class="btn btn-warning card-title me-2">Очистить</a>
                        </div>

                        @if(session('check'))
                            <div class="alert alert-{{session('check')[1]}} mt-2 alert-dismissible"
                                style="width:96%; margin-left: 22px;" role="alert">
                                {{session('check')[0]}}<br>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- /.card-header -->
                        <div class="card-body">

                            <table class="table table-bordered table-dark">
                                <thead class="text-success">
                                    <tr>
                                        <th class="text-success">ID</th>
                                        <th class="text-success">NAME</th>
                                        <th class="text-success">FOODS</th>
                                        <th class="text-success">OPTION</th>
                                        <th class="text-success">EDIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($igredients as $igredient)
                                        <tr>
                                            <td class="text-primary">{{$igredient->id}}</td>
                                            <td class="text-primary">{{$igredient->name}}</td>
                                            <td style="width:100px">
                                                <!-- Button Igredients modal -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#Igredients{{$igredient->id}}">
                                                    Блюда
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="Igredients{{$igredient->id}}" tabindex="-1"
                                                    aria-labelledby="IgredientsLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-dark">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-1" id="IgredientsLabel"
                                                                    style="color:blue">Можно готовить:</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-primary">

                                                                <select class="form-control bg-dark border-primary">
                                                                    @foreach ($igredient->foods as $food)

                                                                        <div class="col-1">
                                                                            <option class="fs-4 btn btn-success">{{$food->name}}</option>
                                                                        </div>

                                                                    @endforeach
                                                                </select>

                                                                @if ($igredient->foods->count() == 0)
                                                                    <h3>Нет блюд!</h3>
                                                                @else
                                                                    <hr style="background-color:black">

                                                                    <h3 class="text-success">Количество:
                                                                        {{$igredient->foods->count()}}
                                                                    </h3>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Закрыть</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width:160px">
                                                <form action="{{route('igredient.delete', $igredient->id)}}" method="POST"
                                                    style="display: inline-flex">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger me-2"><i
                                                            class="bi bi-trash-fill"></i></button>
                                                </form>
                                            </td>
                                            <td style="width:60px">
                                                <!-- Кнопка обновление продукта -->
                                                <button type="button" class="btn btn-primary card-title me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#UpdateIgredient{{$igredient->id}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <!-- Внутренности -->
                                                <div class="modal fade" id="UpdateIgredient{{$igredient->id}}" tabindex="-1"
                                                    aria-labelledby="UpdateIgredientLabel" aria-hidden="true">
                                                    <div class="modal-dialog"
                                                        style="border: 1px solid blue; border-radius:7px">
                                                        <div class="modal-content bg-dark">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-primary"
                                                                    id="UpdateIgredientLabel">
                                                                    Обновление
                                                                    блюдо: {{$igredient->id}}</h1>
                                                                <button type="button" class="btn-close btn-dark"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('igredient.update', $igredient->id)}}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div>
                                                                        <label for="name" class="form-label"></label>
                                                                        <input type="text"
                                                                            class="form-control text-center text-primary border-primary bg-dark"
                                                                            id="name" name="name"
                                                                            value="{{$igredient->name}}"
                                                                            placeholder="Название еды">
                                                                    </div>
                                                                    <div class="modal-footer" style="margin-top:42px">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Назад</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Обновить</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <div class="d-flex justify-content-center bg-dark">
                            {{$igredients->links()}}
                        </div>

                    </div>
                </div>

            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection