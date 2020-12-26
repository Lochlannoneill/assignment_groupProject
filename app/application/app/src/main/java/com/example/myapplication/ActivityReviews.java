package com.example.myapplication;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.recyclerview.widget.RecyclerView;

import com.google.android.material.navigation.NavigationView;

public class ActivityReviews extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    DrawerLayout drawerLayout;
    ActionBarDrawerToggle toggle;
    NavigationView navigationView;
    private RecyclerView recyclerView;
    private RecyclerView.Adapter adapter;
    private String[] reviewerNames, reviewerRatings, reviewerMessages;
    private View viewReviewlist;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reviews);
        Toolbar toolbar = findViewById(R.id.toolbar);
        toolbar.setTitle("");
        setSupportActionBar(toolbar);

        drawerLayout = findViewById(R.id.drawer);
        navigationView = findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        toggle = new ActionBarDrawerToggle(this, drawerLayout, toolbar, R.string.open, R.string.close);
        drawerLayout.addDrawerListener(toggle);
        toggle.setDrawerIndicatorEnabled(true);
        toggle.syncState();

    }

//    @Override
//    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
//
//        viewReviewlist = inflater.inflate(R.layout.content_reviews, container, false);
//        recyclerView = viewReviewlist.findViewById(R.id.review_list);
//        recyclerView.setLayoutManager(new LinearLayoutManager(viewReviewlist.getContext()));
//
//        reviewerNames = getResources().getStringArray(R.array.reviewer_names);
//        reviewerRatings = getResources().getStringArray(R.array.reviewer_ratings);
//        reviewerMessages = getResources().getStringArray(R.array.reviewer_messages);
//        adapter = new RecyclerviewAdapterReview(reviewerNames, reviewerRatings, reviewerMessages);
//        recyclerView.setAdapter(adapter);
//
//        //set linear layout to display items vertically
//        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getActivity(), RecyclerView.VERTICAL, false);
//        recyclerView.setLayoutManager(linearLayoutManager);
//        //return this view on create
//        return viewReviewlist;
//
//    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        drawerLayout.closeDrawer(GravityCompat.START);
        //            setContentView(R.layout.activity_login);

        if (item.getItemId() == R.id.menu_home) {
            setContentView(R.layout.activity_main);
            Intent newIntent = new Intent(this, MainActivity.class);
            startActivity(newIntent);
        }
        else if (item.getItemId() == R.id.menu_login_or_register) {
            Intent newIntent = new Intent(this, LoginActivity.class);
            startActivity(newIntent);
        }
        else if (item.getItemId() == R.id.menu_logout) {
            Toast.makeText(this, "{Username} logged out", Toast.LENGTH_LONG).show();
            Intent newIntent = new Intent(this, LoginActivity.class);
            startActivity(newIntent);
        }
//        else if (item.getItemId() == R.id.menu_reviews) {
//            Intent newIntent = new Intent(this, ActivityReviews.class);
//            startActivity(newIntent);
//        }
        else if (item.getItemId() == R.id.menu_specifications) {
            Intent newIntent = new Intent(this, ActivitySpecifications.class);
            startActivity(newIntent);
        }
        else if (item.getItemId() == R.id.menu_support) {
            Intent newIntent = new Intent(this, ActivitySupport.class);
            startActivity(newIntent);
        }
        return false;
    }
}