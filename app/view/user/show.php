<?$query_name = $_GET;
    $query_name['sort_by'] = 'name';
    $query_name['sort_desc'] = 'ASC';
    $q_name = http_build_query($query_name);
  $query_email = $_GET;
    $query_email['sort_by'] = 'email';
    $query_email['sort_desc'] = 'ASC';
    $q_email = http_build_query($query_email);
$class_arrow_name = 'two_arrow';

if(isset($_GET['sort_by'])) {
    switch ($_GET['sort_by']) {
        case 'name':
            $query_name['sort_desc'] =
                (isset($_GET['sort_desc']) && $_GET['sort_desc'] == 'DESC' ? 'ASC' : 'DESC');
            $query_name_result = http_build_query($query_name);
            $class_arrow_name = (isset($_GET['sort_desc'])
            && $_GET['sort_desc'] == 'DESC' ? 'top_arrow' : 'bottom_arrow');
            break;
        case 'email':
            $query_email['sort_desc'] =
                (isset($_GET['sort_desc']) && $_GET['sort_desc'] == 'DESC' ? 'ASC' : 'DESC');
            $query_email_result = http_build_query($query_email);
            $class_arrow_name = (isset($_GET['sort_desc'])
            && $_GET['sort_desc'] == 'DESC' ? 'top_arrow' : 'bottom_arrow');
            break;
    }
}
    ?>


    <table class="table table-dark table-responsive">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"><a href="<?php echo $_SERVER['REQUEST_URI'] . '?'?><? echo isset($query_name_result) ? $query_name_result : $q_name; ?>" class="<?=$class_arrow_name?>">
                    Имя
                </a></th>
            <th scope="col"><a href="<?php echo $_SERVER['REQUEST_URI'] . '?'?><? echo isset($query_email_result) ? $query_email_result : $q_email; ?>" class="<?=$class_arrow_name?>">
                    Email
                </a></th>
            <th scope="col">Фото</th>
            <th scope="col">Ключ API</th>
            <th scope="col">Авторизация</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; foreach($users as $key => $val):$i++;?>
            <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $val['name']?></td>
                <td><?php echo $val['email']?></td>
                <td><img src="/uploads/<?php echo $val['photo']?>" class="h-50"></td>
                <td><?php echo $val['api_key']?></td>
                <td><?php echo $val['status']?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<h2 class="text-light bg-dark">Чтобы воспользоваться API введите в адресную строку <?php echo $_SERVER['SERVER_NAME'] . '/api/'?>ваше ключ API ?format= формат в котором вы хотите получить данные(json либо xml).
пример <?php echo $_SERVER['SERVER_NAME'] . '/api/123?format=xml'?></h2>
