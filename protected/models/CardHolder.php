<?php

/**
 * This is the model class for table "card_holder".
 *
 * The followings are the available columns in table 'card_holder':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property integer $gender
 * @property string $birth_date
 * @property string $phone
 * @property string $mobile
 * @property integer $civil_status
 * @property string $address
 * @property string $email
 * @property string $zip_code
 * @property integer $is_student
 * @property integer $is_employed
 * @property string $occupation
 * @property string $company
 * @property string $company_school_address
 * @property string $card_no
 * @property string $date_created
 * @property string $start_date
 * @property string $expiration_date
 * @property integer $card_type
 *
 * The followings are the available model relations:
 * @property PromoCards $cardType
 * @property Orders[] $orders
 */
class CardHolder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'card_holder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, middle_name, birth_date, phone, mobile, address, zip_code, company_school_address, card_no, date_created, card_type', 'required'),
			array('gender, civil_status, is_student, is_employed, card_type', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, middle_name, email, card_no', 'length', 'max'=>100),
			array('phone, mobile, occupation, company', 'length', 'max'=>50),
			array('address, company_school_address', 'length', 'max'=>255),
			array('zip_code', 'length', 'max'=>4),
			array('start_date, expiration_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, first_name, last_name, middle_name, gender, birth_date, phone, mobile, civil_status, address, email, zip_code, is_student, is_employed, occupation, company, company_school_address, card_no, date_created, start_date, expiration_date, card_type', 'safe', 'on'=>'search'),
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
			'card' => array(self::BELONGS_TO, 'PromoCards', 'card_type'),
			'orders' => array(self::HAS_MANY, 'Orders', 'card_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'middle_name' => 'Middle Name',
			'gender' => 'Gender',
			'birth_date' => 'Birth Date',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'civil_status' => 'Civil Status',
			'address' => 'Address',
			'email' => 'Email',
			'zip_code' => 'Zip Code',
			'is_student' => 'Is Student',
			'is_employed' => 'Is Employed',
			'occupation' => 'Occupation',
			'company' => 'Company',
			'company_school_address' => 'Company School Address',
			'card_no' => 'Card No',
			'date_created' => 'Date Created',
			'start_date' => 'Start Date',
			'expiration_date' => 'Expiration Date',
			'card_type' => 'Card Type',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('civil_status',$this->civil_status);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('zip_code',$this->zip_code,true);
		$criteria->compare('is_student',$this->is_student);
		$criteria->compare('is_employed',$this->is_employed);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('company_school_address',$this->company_school_address,true);
		$criteria->compare('card_no',$this->card_no,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('expiration_date',$this->expiration_date,true);
		$criteria->compare('card_type',$this->card_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CardHolder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
