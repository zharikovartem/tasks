<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    
    

    <title>Task!</title>
  </head>
  <body>
    <h1>Task:</h1>

    <?php if ($toasts != null): ?>
            <div class="alert alert-success" role="alert">
                <strong>Well done!</strong> <?php echo $toasts; ?>
            </div>
    <?php Task::cleareToasts(); endif; ?>

    <div class="d-flex justify-content-end">
    <?php if ( User::isGuest() ): ?>
        <a type="button" href="user/login" class="btn btn-primary mr-5 mb-1" style="color: white;">Login</a>
    <?php endif; ?>
    <?php if ( !User::isGuest() ): ?>
        <a type="button" href="user/logout" class="btn btn-primary mr-5 mb-1" style="color: white;">LogOut</a>
    <?php endif; ?>
        
        <a type="button" href="/create" class="btn btn-primary mr-5 mb-1" style="color: white;">Create new tasck</a>
    </div>


    <table class="table table-hover">
        <thead>
            <tr>
                <!-- <th>ID<i class="fa fa-fw fa-sort"></i></th> -->
                <th>
                    <form action="#" method="post" class="m-0">
                        <input class="d-none" type="text" name="sort" value="userName"/>
                        <button type="submit" class="btn btn-link">User name</button>
                    </form>
                </th>
                <th>
                    <form action="#" method="post" class="m-0">
                        <input class="d-none" type="text" name="sort" value="email"/>
                        <button type="submit" class="btn btn-link">Email</button>
                    </form>
                </th>
                <th>
                    <form action="#" method="post" class="m-0">
                        <input class="d-none" type="text" name="sort" value="discriptions"/>
                        <button type="submit" class="btn btn-link">Discriptions</button>
                    </form>
                </th>
                <?php if ($user['status'] == 'admin'): ?>
                    <th>
                        <form action="#" method="post" class="m-0">
                            <input class="d-none" type="text" name="sort" value="completed"/>
                            <button type="submit" class="btn btn-link">Status</button>
                        </form>
                    </th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($newsList as $newsItem):?>
            <tr>
                <!-- <th scope="row"><?php echo $newsItem['id']?></th> -->
                <td><?php echo $newsItem['userName']?></td>
                <td><?php echo $newsItem['email']?></td>
                <td><?php echo $newsItem['discriptions']; if ($newsItem['edited'] == 1) {echo '<b>(edited)</b>';}?></td>
                <?php if ($user['status'] == 'admin'): ?>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" data-id="<?php echo $newsItem['id']?>"
                            <?php if ($newsItem['completed'] == 1){ echo 'checked';} ?>
                             class="custom-control-input" id="customSwitch<?php echo $newsItem['id']?>">
                            <label class="custom-control-label" for="customSwitch<?php echo $newsItem['id']?>"></label>
                        </div>
                    </td>
                    <td>
                        <a type="button" href="edit/<?php echo $newsItem['id']?>" class="btn btn-info" style="color: white;">Edit</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    <nav aria-label="Page navigation example">
    <?php echo $pagination->get();?>
    </nav>
    </div>
    

    <!-- Optional JavaScript -->
    

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script>
        $(".custom-control-input").click(function(event) {
            let target = event.target || event.srcElement;
            let params = {
                checked: target.checked,
                data_id: $(this).attr('data-id')
            }
            $.post('/views/tasks/ajaxListner.php', params, function(data) {

            });
        });
        
    </script>

  </body>
</html>