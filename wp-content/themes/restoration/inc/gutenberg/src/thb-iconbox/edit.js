import { format_image } from '@wordpress/icons';

import uniqueID from '../global';
const { Component, Fragment } = wp.element;
const { Button, Icon } = wp.components;
const { BlockControls, AlignmentToolbar, RichText, MediaUpload, MediaUploadCheck } = wp.blockEditor;
const { __ } = wp.i18n;

export class Edit extends Component {

  constructor( props ) {
    super( ...props );

    this.generateID = this.generateID.bind( this );
  }

	componentDidMount() {

    const self = this;

    self.generateID();

	}

  generateID(){
    const self = this;

    // fix for duplicating a block ( same uid )
    if ( self.props.attributes.uid !== '' ){
      const found_uid = document.querySelectorAll( '#' + self.props.attributes.uid );

      if ( found_uid.length > 1 ){
          self.props.setAttributes({ uid : uniqueID() });
      }
    }
    // create id
    else {
      self.props.setAttributes({
				uid : uniqueID()
			});
    }
  }

  render(){
    const self = this;

    const {
        setAttributes,
        attributes,
        isSelected,
    } = self.props;

    const {
        uid,
        title,
				subtitle,
				image,
        alignment,
    } = attributes;

		const classes = [ 'restoration', 'thb-iconbox', self.props.className, alignment ];


    return [

        isSelected && (

            <BlockControls key = { 'controls' }>
                <AlignmentToolbar
                    value={alignment}
                    onChange={ ( nextAlign ) => setAttributes( { alignment: nextAlign } ) }
                />
            </BlockControls>

        ),

        <Fragment>
          <div
            id = { uid }
            className={ classes.join( ' ' ) }
          >
						<div className = {'thb-iconbox'} >
							<div className = {'thb-iconbox-image'} >
								<MediaUploadCheck>
									<MediaUpload
										onSelect={ ( media ) => {
											setAttributes( { image: media } )
										}}
										allowedTypes={ ['image'] }
										multiple={ false }
										value={ image ? image.id : '' }
										render={ ( { open } ) => (
											image ? <img src={ image.url} onClick={ open } /> : <Button onClick={ open } className={'block-editor-button-block-appender'}>
											<Icon
													icon={
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false"><path d="M10 1c-5 0-9 4-9 9s4 9 9 9 9-4 9-9-4-9-9-9zm0 16c-3.9 0-7-3.1-7-7s3.1-7 7-7 7 3.1 7 7-3.1 7-7 7zm1-11H9v3H6v2h3v3h2v-3h3V9h-3V6zM10 1c-5 0-9 4-9 9s4 9 9 9 9-4 9-9-4-9-9-9zm0 16c-3.9 0-7-3.1-7-7s3.1-7 7-7 7 3.1 7 7-3.1 7-7 7zm1-11H9v3H6v2h3v3h2v-3h3V9h-3V6z"></path></svg>
													}
											/>
											</Button>
										) }
									/>
								</MediaUploadCheck>
							</div>
							<div className = {'thb-iconbox-inner'} >
								<RichText
	                tagName="h6"
	                value={ title } // Any existing content, either from the database or an attribute default
	                formattingControls={ [ 'bold', 'italic', 'link' ] }
	                onChange={ ( e ) => setAttributes( { title: e } ) }
	                placeholder={ __( 'Title' ) } // Display this text before any content has been added by the user
	            	/>
								<RichText
	                tagName="p"
	                value={ subtitle } // Any existing content, either from the database or an attribute default
	                formattingControls={ [ 'bold', 'italic', 'link' ] }
	                onChange={ ( e ) => setAttributes( { subtitle: e } ) }
	                placeholder={ __( 'Subtitle' ) } // Display this text before any content has been added by the user
	            	/>
							</div>
						</div>
          </div>
        </Fragment>

    ]
  }
}
