PGDMP          "            
    z         
   apr_landon    10.4    13.2 /    A           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            B           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            C           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            D           1262    16386 
   apr_landon    DATABASE     x   CREATE DATABASE apr_landon WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'en_US.UTF-8' TABLESPACE = tblspc_data;
    DROP DATABASE apr_landon;
                postgres    false            �            1259    16387    clients    TABLE     .  CREATE TABLE public.clients (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    last_name character varying(255) NOT NULL,
    address character varying(255) NOT NULL,
    zip_code character varying(255) NOT NULL,
    city character varying(255) NOT NULL,
    state character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);

ALTER TABLE ONLY public.clients REPLICA IDENTITY FULL;
    DROP TABLE public.clients;
       public            postgres    false            �            1259    16393    clients_id_seq    SEQUENCE     �   CREATE SEQUENCE public.clients_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.clients_id_seq;
       public          postgres    false    196            E           0    0    clients_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.clients_id_seq OWNED BY public.clients.id;
          public          postgres    false    197            �            1259    16395 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public            postgres    false            �            1259    16398    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    198            F           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    199            �            1259    16400    password_resets    TABLE     �   CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 #   DROP TABLE public.password_resets;
       public            postgres    false            �            1259    16406    reservations    TABLE       CREATE TABLE public.reservations (
    id integer NOT NULL,
    date_in date NOT NULL,
    date_out date NOT NULL,
    client_id integer NOT NULL,
    room_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
     DROP TABLE public.reservations;
       public            postgres    false            �            1259    16409    reservations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.reservations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.reservations_id_seq;
       public          postgres    false    201            G           0    0    reservations_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.reservations_id_seq OWNED BY public.reservations.id;
          public          postgres    false    202            �            1259    16411    rooms    TABLE     �   CREATE TABLE public.rooms (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    floor integer NOT NULL,
    description text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.rooms;
       public            postgres    false            �            1259    16417    rooms_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rooms_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.rooms_id_seq;
       public          postgres    false    203            H           0    0    rooms_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.rooms_id_seq OWNED BY public.rooms.id;
          public          postgres    false    204            �            1259    16419    ses    TABLE     M   CREATE TABLE public.ses (
    id integer NOT NULL,
    nama character(20)
);
    DROP TABLE public.ses;
       public            postgres    false            �            1259    16422    users    TABLE     C  CREATE TABLE public.users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public            postgres    false            �            1259    16428    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    206            I           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    207            �           2604    16430 
   clients id    DEFAULT     h   ALTER TABLE ONLY public.clients ALTER COLUMN id SET DEFAULT nextval('public.clients_id_seq'::regclass);
 9   ALTER TABLE public.clients ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    197    196            �           2604    16431    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    199    198            �           2604    16432    reservations id    DEFAULT     r   ALTER TABLE ONLY public.reservations ALTER COLUMN id SET DEFAULT nextval('public.reservations_id_seq'::regclass);
 >   ALTER TABLE public.reservations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    202    201            �           2604    16433    rooms id    DEFAULT     d   ALTER TABLE ONLY public.rooms ALTER COLUMN id SET DEFAULT nextval('public.rooms_id_seq'::regclass);
 7   ALTER TABLE public.rooms ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    204    203            �           2604    16434    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    207    206            3          0    16387    clients 
   TABLE DATA           |   COPY public.clients (id, title, name, last_name, address, zip_code, city, state, email, created_at, updated_at) FROM stdin;
    public          postgres    false    196   H4       5          0    16395 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    198   �4       7          0    16400    password_resets 
   TABLE DATA           C   COPY public.password_resets (email, token, created_at) FROM stdin;
    public          postgres    false    200   U5       8          0    16406    reservations 
   TABLE DATA           i   COPY public.reservations (id, date_in, date_out, client_id, room_id, created_at, updated_at) FROM stdin;
    public          postgres    false    201   r5       :          0    16411    rooms 
   TABLE DATA           U   COPY public.rooms (id, name, floor, description, created_at, updated_at) FROM stdin;
    public          postgres    false    203   p6       <          0    16419    ses 
   TABLE DATA           '   COPY public.ses (id, nama) FROM stdin;
    public          postgres    false    205   �6       =          0    16422    users 
   TABLE DATA           b   COPY public.users (id, name, email, password, remember_token, created_at, updated_at) FROM stdin;
    public          postgres    false    206   7       J           0    0    clients_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.clients_id_seq', 57, true);
          public          postgres    false    197            K           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 5, true);
          public          postgres    false    199            L           0    0    reservations_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.reservations_id_seq', 17, true);
          public          postgres    false    202            M           0    0    rooms_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.rooms_id_seq', 4, true);
          public          postgres    false    204            N           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 1, false);
          public          postgres    false    207            �           2606    16436    clients clients_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.clients
    ADD CONSTRAINT clients_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.clients DROP CONSTRAINT clients_pkey;
       public            postgres    false    196            �           2606    16438    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    198            �           2606    16440    reservations reservations_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.reservations
    ADD CONSTRAINT reservations_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.reservations DROP CONSTRAINT reservations_pkey;
       public            postgres    false    201            �           2606    16442    rooms rooms_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.rooms
    ADD CONSTRAINT rooms_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.rooms DROP CONSTRAINT rooms_pkey;
       public            postgres    false    203            �           2606    16444    ses ses_pkey 
   CONSTRAINT     J   ALTER TABLE ONLY public.ses
    ADD CONSTRAINT ses_pkey PRIMARY KEY (id);
 6   ALTER TABLE ONLY public.ses DROP CONSTRAINT ses_pkey;
       public            postgres    false    205            �           2606    16446    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    206            �           2606    16448    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    206            �           1259    16449    password_resets_email_index    INDEX     X   CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);
 /   DROP INDEX public.password_resets_email_index;
       public            postgres    false    200            �           2606    16455 )   reservations reservations_room_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.reservations
    ADD CONSTRAINT reservations_room_id_foreign FOREIGN KEY (room_id) REFERENCES public.rooms(id);
 S   ALTER TABLE ONLY public.reservations DROP CONSTRAINT reservations_room_id_foreign;
       public          postgres    false    2994    201    203            3   m   x�3��-�p�Qp�)-.I-R0�JMLQPS/�,I��/*�4500�t���+-I�ˬ�,H/.�	qqȃ�%��r��q��([�[�p��qqq e�      5   �   x�U���0��k�0�������L�	2�My}�����_n�؃	,��a0�E��j%�&m���>c�K�;L��mr�NZ��C8
����ؠ_�h�w��[_��4�k�#�}m���˘�ʯ'��|�D�      7      x������ � �      8   �   x�u���� E�RE��1�+������Q2x�o�D��q���fX���다c����e{@L��1�_*���!|�XQ�1ҭC�����;��#?�F�������
G��.|�Cl���uH�_#F�Be�8�O�4d�6�81���0b�O�u��}�\��|f�dgAZ�ͷ~#�/�a^ZA�{�,���ع��<�w���,)-b���h�g�w��/"�P��i      :   -   x�3�440�4���".# ��5�4���&@������ `^
�      <   O   x�3�t,�LMS@\F��%E��h�Ɯ���
�M8�K��хM9]J�1T�qF��`b�镟�X����"���� ���      =   �   x�-��
�P E���ŧ�s��%�s$n^ij�q�� �Áwq��5zV^]V�t�����s@�DVv�簂֬�[��R�F��\��6�F���"�4���sA)�U�%x_�o�m��]���c�������Q� ��0mgO��.�� �c%���X$���0�����&I�;�>�     