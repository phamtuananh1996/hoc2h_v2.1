<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->createPermissions();
       $this->createRoles();
       $this->createCategories();
       $this->createTags();
       $this->createUsers();
       $this->createQuestions();
       $this->createQuestionAnswers();
       $this->createQuestionsTags();
       $this->createTest();
       $this->createTestQuestions();
       $this->createTestQuestionAnswers();
        
    }
    public function createPermissions() {

    	$default_permissions = [

			'view_users',
			'add_users',
			'edit_users',
			'delete_users',
			'set_role',

			'view_roles',
	        'add_roles',
	        'edit_roles',
	        'delete_roles',

	        'view_permissions',
	        'add_perrmissions',
	        'edit_permissions',
	        'delete_permissions',
	        'reset_permissions',

	        'view_categories',
	        'add_categories',
	        'edit_categories',
	        'delete_categories',

	        'view_tags',
	        'add_tags',
	        'edit_tags',
	        'delete_tags',

	        'view_questions',
	        'add_quesstions',
	        'edit_questions',
	        'delete_questions',
	        'set_best_answer',
	        'request_answer',
	        'vote_questions',
	        'set_rosolved',

	        'view_answers',
	        'add_answers',
	        'edit_answers',
	        'delete_answers',
	        'vote_answers',
	        'report_answers',

	        'view_answer_comments',
	        'add_answer_comments',
	        'edit_answer_comments',
	        'delete_answer_comments',
	        'vote_answers_comments',


	        'view_tests',
	        'add_tests',
	        'edit_tests',
	        'delete_tests',
	        'rate_tests',
	        'commemt_tests',
	        'attend_tests',
	        'show_test_results',
	        'check_test_result',
	        ];
	    foreach ($default_permissions as $key => $perms) {
	    	Permission::firstOrCreate(['name' => $perms]);
	    }
    }

    public function createRoles(){
    	$role_names = ['SuperAdmin','Admin','Editor','Member','Guest'];
    	foreach ($role_names as $key => $name) {
            $role  = Role::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
    		if ($name == 'SuperAdmin' || $name == 'Admin') {
    			$role->syncPermissions(Permission::all());
    		} else {
    			if ($name == 'Editor') {
    				$role->syncPermissions(Permission::where('name','LIKE','view_%')->orWhere('name','LIKE','add_%')->orWhere('name','LIKE','edit_%')->get());
    			}else  if($name == 'Member'){
    				$role->syncPermissions(Permission::where('name','LIKE','view_%')->orWhere('name','LIKE','add_%')->get());
    			} else {
                    $role->syncPermissions(Permission::where('name','LIKE','view_%')->get());
                }
    		}
    	}
    }

    public function createTags() {
    	$faker = Faker::create();
    	$categories = [1,2,3,4];
    	foreach (range(1, 25) as $index) {
    	 	App\Tag::create([
    	 			'name'=> $faker->word,
    	 			'category_id' => $faker->randomElement($categories),
    	 			'descriptions' => $faker->text($maxNbChars = 200),
    	 		]);
    	 } 
    }

    public function createCategories() {
    	$faker = Faker::create();
    	$categories = ['Kiến Thức THPT','Kiến Thức THCS','Công Nghệ & Tin Học','Ngoại Ngữ'];
    	foreach ($categories as $key => $category) {
    		App\Category::create([
    				'parent_id'=> 0,
    				'name'=> $category,
    				'descriptions' => $faker->text($maxNbChars = 200) ,
    				'order_display' => $key,
    			]);
    	}
    }

    public function createUsers() {
        $role_names = ['SuperAdmin','Admin','Editor','Member','Guest'];
    	$user_names  = ['super_admin','admin','aries_1992','zumihuong','tuananh'];
    	$email = ['hoc2h.admin@gmail.com','admin@gmail.com','nhamkthd92@gmail.com','hoanghuong@gmail.com','tuananh@gmail.com'];
        foreach ($user_names as $key => $name) {
           $user = App\User::create([
                'user_name' => $name,
                'email' => $email[$key],
                'password'=> Hash::make('abc123'),
            ]);
           $user->assignRole($role_names[$key]);
           App\UserProfile::create(['user_id' => $user->id]);
        }
    }

    public function createQuestions(){
        $faker = Faker::create();
        $users = App\User::all()->pluck('id')->all();
        $categories = App\Category::all()->pluck('id')->all();

        foreach(range(1,50) as $index){
            $question = App\Question::create([
                'title' => $faker->text,
                'user_id' => $faker->randomElement($users),
                'category_id' => $faker->randomElement($categories),
                'body' => $faker->text($maxNbChars = 400),
            ]);
        }
    }

    public function createQuestionAnswers(){
        $faker = Faker::create();
        $users = App\User::all()->pluck('id')->all();
        $questions = App\Question::all()->pluck('id')->all();
        foreach(range(1,300) as $index){
            $company = App\QAnswer::create([
                'question_id' => $faker->randomElement($questions),
                'user_id' => $faker->randomElement($users),
                'body' => $faker->text($maxNbChars = 200),
            ]);
        }
    }

    public function createQuestionsTags() {
        $faker = Faker::create();
        $questions = App\Question::all()->pluck('id')->all();
        $tags = App\Tag::all()->pluck('id')->all();

        foreach(range(1,150) as $index){
            $company = App\QuestionTag::create([
                'question_id' => $faker->randomElement($questions),
                'tag_id' => $faker->randomElement($tags),
            ]);
        }
    }
    public function createTest(){
        $faker = Faker::create();
        // following line retrieve all the user_ids from DB
        $users = App\User::all()->pluck('id')->all();
        $categories = App\Category::all()->pluck('id')->all();
        $number_of_questions = [10,15,20,25,30];
        $levels = [1,2,3];
        foreach(range(1,30) as $index){
            $company = App\Test::create([
                'title' => $faker->text,
                'user_id' => $faker->randomElement($users),
                'category_id' => $faker->randomElement($categories),
                'number_of_questions' => $faker->randomElement($number_of_questions),
                'times' => $faker->randomElement($number_of_questions),
                'level' => $faker->randomElement($levels),
                'descriptions' => $faker->text($maxNbChars = 200),
            ]);
        }
    }

    public function createTestQuestions(){
        $faker = Faker::create();
        $tests = App\Test::all();
        $conrect_answers = [1,2,3,4];
        foreach ($tests as $test) {
            for ($i=0; $i < $test->number_of_questions; $i++) { 
                App\TestQuestion::create([
                    'test_id' => $test->id,
                    'correct_answer_id' => $faker->randomElement($conrect_answers),
                    'explan' => $faker->text($maxNbChars = 200),
                    'content' => $faker->text($maxNbChars = 300),
                ]);
            }
        }
    }

    public function createTestQuestionAnswers(){
        $faker = Faker::create();
        $m_tests = App\TestQuestion::all();
       
        foreach ($m_tests as $m_test) {
            for ($i=1; $i < 5; $i++) { 
                if ($m_test->incorrect_id == $i) {
                    $is_correct = 1;
                } else $is_correct = 0;
                App\TestQuestionAnswer::create([
                    'question_id' => $m_test->id,
                    'order_display' => $i,
                    'body' => $faker->text,
                    'is_correct' => $is_correct,
                ]);
            }
        }
    }
}
