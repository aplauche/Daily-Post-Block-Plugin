import { registerBlockType } from '@wordpress/blocks'
import { useBlockProps, InspectorControls } from '@wordpress/block-editor'
import { Spinner, RangeControl, Panel, PanelBody } from '@wordpress/components'
import apiFetch from '@wordpress/api-fetch'
import {useState, useEffect} from '@wordpress/element'



registerBlockType('fsd/daily-post', {
  edit({attributes, setAttributes}) {
    const blockProps = useBlockProps();
    const {count} = attributes

    const [posts, setPosts] = useState({
      isLoading: true,
      posts: []
    })

    useEffect(() => {

      const getPost = async () => {
        const response = await apiFetch({ 
          path: `fsd/v1/daily-post?count=${count}`
        });
  
        setPosts({
          isLoading: false,
          posts: response
        })
      }

      getPost()

    }, [count])

    return (
      <>
        <div {...blockProps}>
          {posts.isLoading ? (
            <Spinner />
          ) : (
            posts.posts.map(post => (
              <a href={post.url}>
                <img src={post.img} />
                <h3>{post.title}</h3>
              </a>
            ))
          )}
        </div>
        <InspectorControls>
          <Panel header="Post Controls">
            <PanelBody initialOpen={ true }>
              <RangeControl
                label="Posts to feature"
                value={ count }
                onChange={ ( val ) => setAttributes({count: val}) }
                min={ 1 }
                max={ 10 }
            />
            </PanelBody>
          </Panel>
        </InspectorControls>
      </>
    );
  },
});
