@servers(['web' => 'arief.pribadi@192.168.1.126'])

@setup
    $repository = 'git@192.168.1.151:root/arief_hotel.git';
    $app_dir = '/Users/arief.pribadi/Desktop/'.$branch;
    $prod_dir = '/Users/arief.pribadi/Documents/GitlabProjects/Production/arief_hotel';
    $release = date('dmYHis');
    $releases_dir = '/Users/arief.pribadi/Desktop/releases/'.$branch;
    $new_release_dir = $releases_dir .'/'. $release;
@endsetup

@story('deploy')
    echo
    development
@endstory

@task('echo')
    echo "repository        : {{$repository}}";
    echo "releases_dir      : {{$releases_dir}}";
    echo "app_dir           : {{$app_dir}}";
    echo "release           : {{$release}}";
    echo "new_release_dir   : {{$new_release_dir}}";
    echo "branch            : {{$branch}}";
    echo "prod_dir          : {{$prod_dir}}";
@endtask

@task('development')    

    @if ($branch == 'Staging')

        echo 'Cloning repository';
        [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }};
        echo 'git clone -b' {{ $branch }} {{ $repository }} {{ $new_release_dir }};
        git clone -b {{ $branch }} {{ $repository }} {{ $new_release_dir }};
        echo 'Done';

        echo "Starting deployment ({{ $release }})";
        cd {{ $new_release_dir }};
        echo 'Done';

        cp -r {{ $new_release_dir }}/resources/* {{$app_dir}}/resources;
        cp -r {{ $new_release_dir }}/database/* {{$app_dir}}/database;
        cp -r {{ $new_release_dir }}/app/* {{$app_dir}}/app;
        cp -r {{ $new_release_dir }}/public/* {{$app_dir}}/public;
        cp -r {{ $new_release_dir }}/routes/* {{$app_dir}}/routes;
        cp -r {{ $new_release_dir }}/tests/* {{$app_dir}}/tests;
        
        echo 'Done';

    @endif

    @if ($branch == 'Development')

        echo 'Cloning repository';
        [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }};
        echo 'git clone -b' {{ $branch }} {{ $repository }} {{ $new_release_dir }};
        git clone -b {{ $branch }} {{ $repository }} {{ $new_release_dir }};
        echo 'Done';

        echo "Starting deployment ({{ $release }})";
        cd {{ $new_release_dir }};
        echo 'Done';

        cp -r {{ $new_release_dir }}/resources/* {{$app_dir}}/resources;
        cp -r {{ $new_release_dir }}/database/* {{$app_dir}}/database;
        cp -r {{ $new_release_dir }}/app/* {{$app_dir}}/app;
        cp -r {{ $new_release_dir }}/public/* {{$app_dir}}/public;
        cp -r {{ $new_release_dir }}/routes/* {{$app_dir}}/routes;
        cp -r {{ $new_release_dir }}/tests/* {{$app_dir}}/tests;

        echo 'Done';

    @endif

    @if ($branch == 'master')

        echo 'Cloning repository';
        [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }};
        echo 'git clone -b' {{ $branch }} {{ $repository }} {{ $new_release_dir }};
        git clone -b {{ $branch }} {{ $repository }} {{ $new_release_dir }};
        echo 'Done';

        echo "Starting deployment ({{ $release }})";
        cd {{ $new_release_dir }};
        echo 'Done';

        cp -r {{ $new_release_dir }}/resources/* {{$prod_dir}}/resources;
        cp -r {{ $new_release_dir }}/database/* {{$prod_dir}}/database;
        cp -r {{ $new_release_dir }}/app/* {{$prod_dir}}/app;
        cp -r {{ $new_release_dir }}/public/* {{$prod_dir}}/public;
        cp -r {{ $new_release_dir }}/routes/* {{$prod_dir}}/routes;
        cp -r {{ $new_release_dir }}/tests/* {{$prod_dir}}/tests;


        echo 'Done';

    @endif

@endtask


