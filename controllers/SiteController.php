<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use app\models\Post;
use app\models\Comment;
use app\models\AddPostForm;
use app\models\AddCommentForm;

class SiteController extends Controller
{


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function  getPosts (){


        $query = new Query();
        $query->select('post.id, post.user_name, post.created_at, post.content, count(comment.created_at) as cnt_comments ')->from('post');
        $query->join = [['LEFT JOIN', 'comment', 'comment.post_id = post.id']];
        $query->groupBy(['post.id']);
        $query->orderBy('post.created_at DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return  $posts = $dataProvider->getModels();
    }

    public function getComments($id){
        $dataProvider = new ActiveDataProvider([
            'query' => Comment::find()->where(['post_id'=>$id]),
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return  $posts = $dataProvider->getModels();
    }

    /**
     * Список постов. Форма добавления одного поста.
     * @return string
     */
    public function actionIndex()
    {

        $topPosts = (new \yii\db\Query())
            ->select(['post.id', 'post.user_name','post.created_at','post.content','count(comment.created_at) as cnt_comments'])
            ->from('post')
            ->join('LEFT JOIN', 'comment', 'comment.post_id = post.id')
            ->groupBy(['post.id'])
            ->orderBy([
                'cnt_comments' => SORT_DESC
            ])
            ->limit(5)
            ->all();


        $carousel = array();
        foreach ($topPosts as $topPost){
            $carousel[] = $topPost['content'].' <br> Author : '.$topPost['user_name'] . ' <br> Commnets : '.$topPost['cnt_comments']  ;
        }

        $postModel = new Post();
        $postFormModel = new AddPostForm();

        $posts = $this->getPosts();
        if ($postFormModel->load(Yii::$app->request->post()) && $postFormModel->validate()){
            $post = Yii::$app->request->post();

            $postModel->user_name = \yii\helpers\Html::encode($post['AddPostForm']['user_name']);
            $postModel->content = \yii\helpers\Html::encode($post['AddPostForm']['message']);

            $commentFormModel =  new AddCommentForm();

            if($postModel->save()){
                $model = Post::findOne($postModel->id);
                return $this->redirect(array(
                    'post?id='.$postModel->id,
                    'model' => $model,
                    'modelform' => $commentFormModel
                ));
            }
        }


        return $this->render('index', [
            'model' => $postFormModel,
            'posts' => $posts,
            'carousel'=>$carousel
        ]);

    }


    /**
     * Просмотр поста.
     * @return string
     */
    public function actionPost($id)
    {
        $commentModel = new Comment();
        $postFormModel = new AddCommentForm();
        $model = Post::findOne($id);

        $comments = $this->getComments($id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }



        if ($postFormModel->load(Yii::$app->request->post()) && $postFormModel->validate()){
            $post = Yii::$app->request->post();


            $commentModel->post_id = $id;
            $commentModel->author_name =\yii\helpers\Html::encode($post['AddCommentForm']['user_name']);
            $commentModel->content = \yii\helpers\Html::encode($post['AddCommentForm']['comment']);


            if($commentModel->save()){

                return  $this->refresh();
            }
        }


        return $this->render('post', [
            'model' => $model,
            'modelform' => $postFormModel,
            'comments' => $comments
        ]);
    }


}
