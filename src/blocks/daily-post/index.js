import { registerBlockType } from '@wordpress/blocks'
import { useBlockProps } from '@wordpress/block-editor'

registerBlockType('fsd/daily-post', {
  edit() {
    const blockProps = useBlockProps();

    return (
      <div {...blockProps}>
        <a href="#">
          <img src="" />
          <h3>Placeholder Title</h3>
        </a>
      </div>
    );
  },
});