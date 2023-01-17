import { registerBlockType } from '@wordpress/blocks'
import { useBlockProps } from '@wordpress/block-editor'
import { Spinner } from '@wordpress/components'
import apiFetch from '@wordpress/api-fetch'
import {useState, useEffect} from '@wordpress/element'



registerBlockType('fsd/daily-post', {
  edit() {
    const blockProps = useBlockProps();

    const [post, setPost] = useState({
      isLoading: true,
      url: null,
      img: null,
      title: null
    })

    useEffect(() => {

      const getPost = async () => {
        const response = await apiFetch({ 
          path: 'fsd/v1/daily-post'
        });
  
        setPost({
          isLoading: false,
          ...response
        })
      }

      getPost()

    }, [])

    return (
      <div {...blockProps}>
        {post.isLoading ? (
          <Spinner />
        ) : (
          <a href={post.url}>
            <img src={post.img} />
            <h3>{post.title}</h3>
          </a>
        )}
      </div>
    );
  },
});
