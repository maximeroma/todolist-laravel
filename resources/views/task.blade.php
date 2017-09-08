<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .error {
              color:red;
            }

            .TODO {
              color:green;
            }

            .DONE {
              color:red;
              text-decoration: line-through;
            }
        </style>
    </head>
    <body>
      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/task">
          <i class="fa fa-diamond" aria-hidden="true"></i>
            MyTDL
          </a>
        </nav>
      <br>
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            <div class="row">
              <div class="container-fluid">
                <div class="card border-primary">
                  <div class="card-header">Formulaire</div>
                  <div class="card-body">
                    <form action="/task" method="post">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="task">Ajouter une tache</label>
                        <input class="form-control" type="text" name="task" id="task">
                      </div>
                      @if($errors)
                        <div class="error"><small> {{ $errors->task->first('task') }} </small></div>
                      @endif
                      <div class="form-group">
                        <label for="select">Attacher à une liste</label>
                        <select class="form-control" name="select" id="select">
                          <option  value="0" selected>Mes listes</option>
                          @foreach ($lists as $list)
                          <option value="{{ $list->id }}">{{ $list->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <input type="submit" class="btn btn-primary">
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="container-fluid">
                <table class="table">
                  <thead class="thead-default">
                    <th>ID</th>
                    <th>Tache à faire</th>
                    <th>Etat</th>
                    <th>Supprimer</th>
                  </thead>
                  <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                      <td>{{ $task->id }}</td>
                      <td
                      @if ( $task->state )
                      class="DONE"
                      @else
                      class="TODO"
                      @endif
                      >
                      {{ $task->name }}
                    </td>
                    <td>
                      <form action="{{ url('task/'. $task->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="state" value="{{ $task->state }}">
                        <button type="submit"
                        @if ($task->state)
                          class="btn btn-success"
                        @else
                          class="btn btn-default"
                        @endif
                        >
                          @if ( $task->state )
                          DONE
                          @else
                          TO DO
                          @endif
                        </button>
                      </form>
                    </td>
                    <td>
                      <form action="{{ url('task/'. $task->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="row">
            <div class="container-fluid">
              <div class="card border-secondary">
                <div class="card-header">Listes</div>
                <div class="card-body">
                  <form class="" action="/list" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="list">Ajouter une liste</label>
                      <input class="form-control" type="text" name="list" id="list">
                    </div>
                    <div class="error"><small> {{ $errors->list->first('list') }}</small></div>
                    <input type="submit" class="btn btn-primary">
                  </form>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <table class="table">
              <thead>
                <th>ID</th>
                <th>Nom de liste</th>
                <th>Voir le détail</th>
                <th>Supprimer</th>
              </thead>
              <tbody>
                @foreach ($lists as $list)
                <tr>
                  <td>{{ $list->id }}</td>
                  <td>
                    {{ $list->name }}
                  </td>
                  <td>
                    <form action="{{ url('list/'. $list->id) }}" method="get">
                      {{ csrf_field() }}
                      <button type="submit" class="btn btn-success">Voir le détail</button>
                    </form>
                  </td>
                  <td>
                    <form action="{{ url('list/'. $list->id) }}" method="post">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>

        </div>
      <script src="https://use.fontawesome.com/686e5943d9.js"></script>
  </body>
</html>
