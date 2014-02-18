<?php

/**
 * This is the model class for table "add_on_sizes".
 *
 * The followings are the available columns in table 'add_on_sizes':
 * @property integer $id
 * @property integer $add_on_id
 * @property integer $size_id
 * @property string $description
 * @property string $price
 *
 * The followings are the available model relations:
 * @property AddOns $addOn
 * @property Sizes $size
 */
class AddOnSizes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'add_on_sizes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('add_on_id, size_id, description, price', 'required'),
			array('add_on_id, size_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>100),
			array('price', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, add_on_id, size_id, description, price', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'addOn' => array(self::BELONGS_TO, 'AddOns', 'add_on_id'),
			'size' => array(self::BELONGS_TO, 'Sizes', 'size_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'add_on_id' => 'Add On',
			'size_id' => 'Size',
			'description' => 'Description',
			'price' => 'Price',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('add_on_id',$this->add_on_id);
		$criteria->compare('size_id',$this->size_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AddOnSizes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
