<?php
namespace wp_infinite\Controller;

class WP_PostController
{
    const POST_STATUS_PUBLISH = 'publish';

    protected $title;
    protected $slug;
    protected $content;
    protected $post_type = 'page';
    protected $post_status = self::POST_STATUS_PUBLISH;
    protected $author_id = 1;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return static
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getPostType()
    {
        return $this->post_type;
    }

    /**
     * @param string $post_type
     */
    public function setPostType($post_type)
    {
        $this->post_type = $post_type;
    }

    /**
     * @return string
     */
    public function getPostStatus()
    {
        return $this->post_status;
    }

    /**
     * @param string $post_status
     */
    public function setPostStatus($post_status)
    {
        $this->post_status = $post_status;
    }

    /**
     * @return int
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * @param int $author_id
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @return array
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param array $posts
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    protected $posts = [
        [
            'title' => 'Intern-Resume-List',
            'slug' => 'resume-list',
            'content' => '[intern_resume_list]',
        ]
    ];


    private function the_slug_exists($post_name) {
        global $wpdb;
        if($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '{$post_name }'", 'ARRAY_A')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool|int|\WP_Error
     */
    public function insertPost()
    {
        $blog_page_check = get_page_by_title($this->title);
        $blog_page = array(
            'post_type' => $this->post_type,
            'post_title' => $this->title,
            'post_name' => $this->slug,
            'post_content' => $this->content,
            'post_status' => $this->post_status,
            'post_author' => $this->author_id,
        );
        if (!isset($blog_page_check->ID) && !$this->the_slug_exists($this->slug)) {
            return wp_insert_post($blog_page);
        }

        return false;
        /**
         * @see https://clicknathan.com/web-design/automatically-create-pages-wordpress/
         */

    }

    public function loadPost($post_id)
    {
        $post = get_post($post_id);
        $this->setTitle($post->post_title);
        $this->setAuthorId($post->post_author);
    }

}
