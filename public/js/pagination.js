const loadMoreBtn = document.querySelector('.btn-load-more');
const postList = document.querySelector('.post-lists');
const paginationLinks = document.querySelector('.pagination-links');

/**
 * Display all posts just fetched from database
 *
 * @param string  post   An array holding all the posts
 */
function displayPosts(posts) {
    posts.forEach(post => {
        let postHtmlString = `
        <div class="col c-12 m-4 l-4">
            <a href="pages/single.php?id=${post.id}">
                <div class="post">
                    <div class="post-thumb">
                        <!-- <img class="post-thumb-img" src="./storage/galleries/1.jpg" alt=""> -->
                        <img src="${post.image}" alt="" class="post-thumb-img">
                    </div>
                    <div class="post-content">
                        <div class="post-topic 
                <?php echo $topicColor[$i];
                ++$i; ?>">
                            ${post.name}
                        </div>
                        <div class="post-title">
                            ${post.title}
                        </div>
                        <div class="post-detail">
                            <div class="post-on">
                            ${post.created_at}
                            </div>
                            <i class="fas fa-circle"></i>
                            <div class="post-viewed">
                                ${post.views} VIEWS
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>`;

        const domParser = new DOMParser();
        const doc = domParser.parseFromString(postHtmlString, 'text/html');
        const postNode = doc.body.firstChild;
        postList.appendChild(postNode);

    });
}

let nextPage = 2;

loadMoreBtn.addEventListener('click', async function(e){
    loadMoreBtn.textContent='Loading...';
    const response = await fetch(`index.php?page=${nextPage}&ajax=1`);
    const data = await response.json();
    displayPosts(data.posts);
    nextPage = data.nextPage;
    if(!data.nextPage){
        paginationLinks.innerHTML = '<div style="color: gray;">No more posts</div>';
    }else{
        loadMoreBtn.textContent = 'Load more';
    }
})